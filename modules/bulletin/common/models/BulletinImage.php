<?php

namespace modules\bulletin\common\models;

use Yii;

/**
 * This is the model class for table "{{%bulletin_image}}".
 *
 * @property int $id
 * @property int $entity_id
 * @property int $image_id
 * @property int $position
 *
 * @property Bulletin $entity
 */
class BulletinImage extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bulletin_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'image_id', 'position'], 'required'],
            [['entity_id', 'image_id', 'position'], 'integer'],
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
            'entity_id' => 'Entity ID',
            'image_id' => 'Image ID',
            'position' => 'Position',
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
