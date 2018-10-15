<?php

namespace modules\bulletin\common\models;

use Yii;

/**
 * This is the model class for table "{{%complaint}}".
 *
 * @property int $id
 * @property int $entity_id
 * @property string $subject
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 * @property int $status_id
 *
 * @property Bulletin $entity
 * @property ComplaintStatus $status
 */
class Complaint extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%complaint}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'subject', 'content'], 'required'],
            ['status_id', 'default', 'value' => 1],
            [['entity_id', 'created_at', 'updated_at', 'status_id'], 'integer'],
            [['content'], 'string'],
            [['subject'], 'string', 'max' => 255],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bulletin::class, 'targetAttribute' => ['entity_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ComplaintStatus::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Объявление',
            'subject' => 'Тема',
            'content' => 'Содержание',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего изменения',
            'status_id' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Bulletin::class, ['id' => 'entity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ComplaintStatus::class, ['id' => 'status_id']);
    }
}
