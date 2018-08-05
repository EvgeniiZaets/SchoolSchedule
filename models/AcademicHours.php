<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "academic_hours".
 *
 * @property int $class_id
 * @property int $subject_id
 * @property int $num_of_hours
 *
 * @property SchoolClass $class
 * @property Subject $subject
 */
class AcademicHours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'academic_hours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'subject_id', 'num_of_hours'], 'required'],
            [['class_id', 'subject_id', 'num_of_hours'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchoolClass::className(), 'targetAttribute' => ['class_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'class_id' => 'Class ID',
            'subject_id' => 'Subject ID',
            'num_of_hours' => 'Num Of Hours',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(SchoolClass::className(), ['id' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public static function generate()
    {
        $class_model = SchoolClass::find()->all();
        foreach ($class_model as $class) {
            $subject_model = Subject::find()->all();
            foreach ($subject_model as $subject) {
                $model = new AcademicHours();
                $model->class_id = $class->id;
                $model->subject_id = $subject->id;
                $model->num_of_hours = rand(1, 6);
                $model->save();
            }
        }
    }
}
