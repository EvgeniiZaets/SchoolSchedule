<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "day_of_week".
 *
 * @property int $id
 * @property string $title
 */
class Day extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'day_of_week';
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
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['day_id' => 'id']);
    }

    public static function findWorkingDays()
    {
        $model = self::find()
            ->where(['<', 'id', 6])
            ->all();
        return $model;
    }
}
