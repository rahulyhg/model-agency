<?php

namespace modules\bulletin\common\models;

use Yii;

/**
 * This is the model class for table "{{%service_bulletin}}".
 *
 * @property int $id
 * @property int $entity_id
 * @property int $service_id
 * @property int $expires_at
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Bulletin $entity
 * @property Service $service
 */
class ServiceBulletin extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%service_bulletin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'service_id', 'expires_at', 'created_at', 'updated_at'], 'required'],
            [['entity_id', 'service_id', 'expires_at', 'created_at', 'updated_at'], 'integer'],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bulletin::className(), 'targetAttribute' => ['entity_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'service_id' => 'Service ID',
            'expires_at' => 'Expires At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Bulletin::className(), ['id' => 'entity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
