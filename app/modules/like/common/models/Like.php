<?php

namespace modules\like\common\models;

use Yii;

/**
 * This is the model class for table "{{%like}}".
 *
 * @property int $id
 * @property int $entity
 * @property int $entity_id
 * @property string $ip
 * @property int $user_id
 * @property int $created_at
 */
class Like extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%like}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity'], 'required'],
            [['entity_id', 'user_id', 'created_at'], 'integer'],
            [['ip'], 'string', 'max' => 20],
            [['entity'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'ID объекта',
            'entity' => 'Hash объекта',
            'ip' => 'IP',
            'user_id' => 'ID пользователя',
            'created_at' => 'Дата создания',
        ];
    }
}
