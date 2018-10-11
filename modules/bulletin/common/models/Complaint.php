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
 *
 * @property Bulletin $entity
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
            [['entity_id', 'subject', 'content', 'created_at', 'updated_at'], 'required'],
            [['entity_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['subject'], 'string', 'max' => 255],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bulletin::className(), 'targetAttribute' => ['entity_id' => 'id']],
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
            'content' => 'Содерждание',
          'created_at' => 'Дата создания',
          'updated_at' => 'Дата последнего обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Bulletin::className(), ['id' => 'entity_id']);
    }
}
