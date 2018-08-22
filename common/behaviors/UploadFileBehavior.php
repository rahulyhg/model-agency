<?php
namespace common\behaviors;

use Codeception\Exception\ConfigurationException;
use yii\base\Behavior;
use yii\base\UnknownPropertyException;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;

/**
 * Class SmUploadFileBehavior
 * ActiveRecord Behavior. Upload file from model attributes use file storage component and init model id attributes
 * @package common\behaviors
 */
class UploadFileBehavior extends Behavior
{
  /**
   * @var array
   * @example
   * - [
   *       'photoFile' => 'photo_img_id',
   *       'docFile'   => 'passport_scan_file_id'
   * - ]
   */
  public $files;

  /**
   * Directory path in filestorage
   * @var string
   */
  public $directory;

  /**
   * Get file as UploadedFile::getInstanceByName($name)
   * -- NOT UploadedFile::getInstanceByName($model, $attr)
   * @var bool
   */
  public $instanceByName = false;

  /**
   * Name of filestorage component
   * @var string
   */
  protected $fileStorageComponentName = 'filestorage';

  /**
   * @throws ConfigurationException
   */
  public function init()
  {
    parent::init();
    if (!isset($this->files) || empty($this->files)) {
      throw new ConfigurationException("files in SmUploadFileBehavior is not defined or empty");
    }
    if (!isset($this->directory) || !is_string($this->directory)) {
      throw new ConfigurationException("directory in SmUploadFileBehavior is not defined / not string");
    }
    if (!is_array($this->files)) {
      throw new ConfigurationException("files in not array in SmUploadFileBehavior");
    }
  }

  /**
   * @inheritdoc
   */
  public function events()
  {
    return [
      BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
      BaseActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
      BaseActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
      BaseActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
    ];
  }

  /**
   * @throws UnknownPropertyException
   */
  public function beforeValidate()
  {
    $model = $this->owner;
    /**
     * @var $model ActiveRecord
     */
    foreach ($this->files as $file) {

      if (!property_exists($model, $file['fileAttribute'])) {
        throw new UnknownPropertyException("Property {$file['fileAttribute']} is not defined");
      }

      if (!(($model->getAttribute($file['fileAttribute'])) instanceof UploadedFile)) {
        if ($this->instanceByName === true) {
          $model->{$file['fileAttribute']} = UploadedFile::getInstanceByName($file['fileAttribute']);
        } else {
          $model->{$file['fileAttribute']} = UploadedFile::getInstance($model, $file['fileAttribute']);
        }
      }

    }
  }

  /**
   * Upload model files before save
   */
  public function beforeSave()
  {
    $model = $this->owner;
    foreach ($this->files as $file) {

      // Remove deleted files on frontend
      if (isset($file['deleteAttribute'])) {
        if ($model->{$file['deleteAttribute']} === '1') {
          if ($this->deleteFile($model->{$file['idAttribute']})) {
            $model->{$file['idAttribute']} = null;
          }
        }
      }

      // Upload file
      $newFileId = $this->uploadFromModel($model, $file['fileAttribute']);
      if ($newFileId) {
        // Delete old file if exist
        if ($model->{$file['idAttribute']}) {
          $this->deleteFile($model->{$file['idAttribute']});
        }
        // Set new file id
        $model->{$file['idAttribute']} = $newFileId;
      }
    }
  }

  /**
   * Delete model files before delete
   */
  public function beforeDelete()
  {
    $model = $this->owner;
    foreach ($this->files as $file) {
      // Delete files
      if ($model->{$file['idAttribute']}) {
        $this->deleteFile($model->{$file['idAttribute']});
      }
    }
  }

  /**
   * Upload file from model and return this id in file storage of false if error
   * @param $model
   * @param $attribute
   * @return mixed
   */
  protected function uploadFromModel($model, $attribute)
  {
    return \Yii::$app->{$this->fileStorageComponentName}->uploadFromModel($model, $attribute, $this->directory);
  }

  /**
   * Delete file from file storage by ID
   * @param $id
   * @return mixed
   */
  protected function deleteFile($id)
  {
    return \Yii::$app->{$this->fileStorageComponentName}->removeFile($id);
  }
}