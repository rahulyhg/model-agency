<?php

namespace modules\mod\common\models;

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
 * @property Mod $entity
 * @property string $url
 */
class ModImage extends \common\lib\ActiveRecord
{
  private $url;

  public function getUrl()
  {
    if(!$this->url) {
      $this->url = Yii::$app->filestorage->getFileUrl($this->image_id);
    }
    return $this->url;
  }

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
  public function getEntity()
  {
    return $this->hasOne(Mod::class, ['id' => 'entity_id']);
  }

  public function beforeDelete()
  {
    if(Yii::$app->filestorage->removeFile($this->image_id)) {
      return parent::beforeDelete();
    }
    return false;
  }
}
