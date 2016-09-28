<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $title
 * @property integer $tasks_type_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['tasks_type_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'tasks_type_id' => 'Тип',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function getTasks_type()
    {
        return $this->hasOne(TasksTypes::className(), ['id' => 'tasks_type_id']);
    }
}
