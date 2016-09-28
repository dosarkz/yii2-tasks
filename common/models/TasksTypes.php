<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tasks_types".
 *
 * @property integer $id
 * @property string $title
 * @property integer $position
 * @property integer $is_default
 * @property integer $created_at
 * @property integer $updated_at
 */
class TasksTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks_types';
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
            [['position', 'is_default', 'created_at', 'updated_at'], 'integer'],
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
            'position' => 'Позиция',
            'is_default' => 'По умолчанию',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
