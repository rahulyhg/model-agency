<?php

namespace modules\bulletin\backend\forms;


use yii\base\Model;
use yii\helpers\Html;
use yii\web\UploadedFile;

class GalleryForm extends Model
{
  public $images;

  public $maxFiles = 8;

  public $isRequired = true;

  public function rules()
  {
    return [
      [['images'], 'required', 'when' => function($model) { return $model->isRequired; }, 'whenClient' => 'function(){ return !$(".file-preview-frame").length; }'],
      [['images'], 'file', 'maxFiles' => $this->maxFiles],
    ];
  }

  public function attributeLabels()
  {
    return [
      'images' => 'Фотографии',
    ];
  }

  const FILE_DIR = 'bulletin/gallery';
  /**
   * @return bool|int[]
   */
  public function upload()
  {
    $this->images = UploadedFile::getInstances($this, 'images');
    if ($this->validate(['images'])) {
      if(empty($this->images)) {
        return true;
      }
      return \Yii::$app->filestorage->multipleUploadFromModel($this, 'images', self::FILE_DIR);
    }
    return false;
  }
}