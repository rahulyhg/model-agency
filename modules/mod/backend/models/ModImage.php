<?php

namespace modules\mod\backend\models;

use modules\mod\common\models\Mod;
use Yii;

/**
 * This is the model class for table "{{%mod_image}}".
 *
 * @property int $id
 * @property int $entity_id
 * @property int $image_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Yii::$app->filestorage $image
 * @property Mod $entity
 */
class ModImage extends \common\lib\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%mod_image}}';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['entity_id', 'image_id'], 'required'],
      [['entity_id', 'image_id', 'created_at', 'updated_at'], 'integer'],
      [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mod::className(), 'targetAttribute' => ['entity_id' => 'id']],
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
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getImage()
  {
    return $this->hasOne(Yii::$app->filestorage::className(), ['id' => 'image_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEntity()
  {
    return $this->hasOne(Mod::className(), ['id' => 'entity_id']);
  }
}
