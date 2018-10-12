<?php

namespace modules\bulletin\backend\forms;


use yii\base\Model;
use yii\web\UploadedFile;

class GalleryForm extends Model
{
  public $images;

  public function rules()
  {
    return [
      [['images'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 8],
    ];
  }

  const FILE_DIR = 'test/gallery';
  /**
   * @return bool|int[]
   */
  public function upload()
  {
    $this->images = UploadedFile::getInstances($this, 'images');
    if ($this->validate(['images'])) {
      return \Yii::$app->filestorage->multipleUploadFromModel($this, 'images', self::FILE_DIR);
    }
    return false;
  }
}