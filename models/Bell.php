<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bell".
 *
 * @property int $id
 * @property string $time_from
 * @property string $time_to
 *
 * @property Schedule[] $schedules
 */
class Bell extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bell';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time_from', 'time_to'], 'required'],
            [['time_from', 'time_to'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time_from' => 'Time From',
            'time_to' => 'Time To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['bell_id' => 'id']);
    }

    public static function findNumByClassAndDay($classId, $dayId)
    {
        $model = self::find()
            ->joinWith('schedules', false)
            ->where([
                'schedule.class_id' => $classId,
                'schedule.day_id' => $dayId
            ])
            ->count();
        return $model;
    }
}
