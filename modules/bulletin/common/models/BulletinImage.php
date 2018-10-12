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
  const MAX_FILES = 8;
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
      [['image'], 'file', 'skipOnEmpty' => false, 'when' => function ($model) {
        return empty($model->file_id);
      }],
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

  const FILES_DIR = 'bulletin/images';

  public function uploadFile($index = null)
  {
    $name = sprintf('%simage', isset($index) ? "[$index]" : "");
    $this->image = \yii\web\UploadedFile::getInstance($this, $name);
    if ($this->image && $this->validate(['image'])) {
      $this->image_id = Yii::$app->filestorage->uploadFromModel($this, $name, self::FILES_DIR);
    }
    return $this->image_id > 0;
  }

  public function beforeDelete()
  {
    if($this->image_id) {
      return \Yii::$app->filestorage->removeFile($this->image_id);
    }
    return true;
  }

  public $image;

  protected $_imageUrl;

  /**
   * @return null|string
   */
  public function getImageUrl()
  {
    if (!$this->_imageUrl) {
      $this->_imageUrl = Yii::$app->filestorage->getFileUrl($this->image_id);
    }
    return $this->_imageUrl;
  }

  protected $_imageSize;

  /**
   * @return int|string
   */
  public function getImageSize()
  {
    if (!$this->_imageSize) {
      $path = Yii::$app->filestorage->getFilePath($this->image_id);
      $this->_imageSize = $path ? filesize($path) : 0;
    }
    return $this->_imageSize;
  }

  protected $_imageCaption;

  public function getImageCaption()
  {
    if (!$this->_imageCaption) {
      $this->_imageCaption = Yii::$app->filestorage->getFileOriginalName($this->image_id);
    }
    return $this->_imageCaption;
  }
}
