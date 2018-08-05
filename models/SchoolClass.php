<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class".
 *
 * @property int $id
 * @property string $title
 *
 * @property AcademicHours[] $academicHours
 */
class SchoolClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicHours()
    {
        return $this->hasMany(AcademicHours::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['class_id' => 'id'])
            ->orderBy(['day_id' => SORT_ASC, 'bell_id' => SORT_ASC]);
    }

    public function getNumSchedulesByDay($dayId)
    {
        return $this->hasMany(Schedule::className(), ['class_id' => 'id'])
            ->where(['day_id' => $dayId])
            ->count();
    }

    public function getSchedulesDay()
    {
        return $this->hasMany(Schedule::className(), ['class_id' => 'id'])
            ->joinWith('days')
            ->groupBy('day.id')
            ->count();
    }
}
