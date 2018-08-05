<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int $day_id
 * @property int $bell_id
 * @property int $teacher_id
 * @property int $class_id
 * @property int $subject_id
 *
 * @property Subject $subject
 * @property Bell $bell
 * @property Day $day
 * @property SchoolClass $class
 * @property Teacher $teacher
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day_id', 'bell_id', 'teacher_id', 'class_id', 'subject_id'], 'required'],
            [['day_id', 'bell_id', 'teacher_id', 'class_id', 'subject_id'], 'integer'],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['bell_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bell::className(), 'targetAttribute' => ['bell_id' => 'id']],
            [['day_id'], 'exist', 'skipOnError' => true, 'targetClass' => Day::className(), 'targetAttribute' => ['day_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchoolClass::className(), 'targetAttribute' => ['class_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day_id' => 'Day ID',
            'bell_id' => 'Bell ID',
            'teacher_id' => 'Teacher ID',
            'class_id' => 'Class ID',
            'subject_id' => 'Subject ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBell()
    {
        return $this->hasOne(Bell::className(), ['id' => 'bell_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDay()
    {
        return $this->hasOne(Day::className(), ['id' => 'day_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchoolClass()
    {
        return $this->hasOne(SchoolClass::className(), ['id' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }

    public static function generate()
    {
        $academicHours = AcademicHours::find()->all();
        $rows = 0;
        foreach ($academicHours as $row) {
            for ($i = 0; $i < $row->num_of_hours; $i++) {
                $schedule = new Schedule();
                $schedule->class_id = $row->class_id;
                $schedule->subject_id = $row->subject_id;
                $schedule->day_id = rand(1, 5);
                $schedule->bell_id = Bell::findNumByClassAndDay($schedule->class_id, $schedule->day_id) + 1;
                $schedule->teacher_id = Teacher::findFree($schedule->day_id, $schedule->bell_id)->id;
                $schedule->save();
                $rows++;
            }
        }
        return $rows;
    }
}
