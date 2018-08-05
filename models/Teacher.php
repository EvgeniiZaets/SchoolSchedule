<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "teacher".
 *
 * @property int $id
 * @property string $name
 *
 * @property Schedule[] $schedules
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['teacher_id' => 'id']);
    }

    /**
     * Ищет свободного учителя на указанный $dayId и $bellId
     * @param $dayId
     * @param $bellId
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function findFree($dayId, $bellId)
    {
        $model = self::find()
            ->select('teacher.id')
            ->where([
                'not exists',
                Schedule::find()->where(
                    new Expression('schedule.teacher_id = teacher.id'))
                ->andWhere(['day_id' => $dayId])
            ->andWhere(['bell_id' => $bellId])
            ])
            ->orderBy(new Expression('rand()'))
            ->one();
        return $model;
    }
}
