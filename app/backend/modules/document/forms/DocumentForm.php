<?php

namespace backend\modules\document\forms;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class DocumentForm extends Model
{
  const FILES_DIR = 'documents/files';

  /**
   * @var UploadedFile
   */
  public $file;

  public function rules()
  {
    return [
      [['file'], 'file',  'skipOnEmpty' => false]
    ];
  }

  public function upload($index = null)
  {
    if($this->validate()) {
      return $this->_fileId = Yii::$app->filestorage->uploadFromModel(
        $this,
        sprintf('%sfile', isset($index) ? "[$index]" : ""),
        self::FILES_DIR
      );
    }
    return false;
  }

  /*public static function uploadRepeater($forms) {
    $flag = true;
    foreach($forms as $i => $form) {
      if($form->validate()) {
        $form->_fileId = Yii::$app->filestorage->uploadFromModel($form, "[$i]file", self::FILES_DIR);
        if ($form->_fileId) {
          continue;
        }
      }
      $flag = false;
      break;
    }
    return $flag;
  }/**/
  
  protected $_fileId;

  protected $_fileUrl;

  /**
   * @return null|string
   */
  public function getFileUrl()
  {
    if (!$this->_fileUrl) {
      $this->_fileUrl = Yii::$app->filestorage->getFileUrl($this->_fileId);
    }
    return $this->_fileUrl;
  }

  protected $_fileSize;

  /**
   * @return int|string
   */
  public function getFileSize()
  {
    if (!$this->_fileSize) {
      $path = Yii::$app->filestorage->getFilePath($this->_fileId);
      $this->_fileSize = $path ? filesize($path) : 0;
    }
    return $this->_fileSize;
  }

  protected $_fileCaption;

  public function getFileCaption()
  {
    if (!$this->_fileCaption) {
      $this->_fileCaption = Yii::$app->filestorage->getFileOriginalName($this->_fileId);
    }
    return $this->_fileCaption;
  }
}