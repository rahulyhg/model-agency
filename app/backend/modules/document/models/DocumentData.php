<?php

namespace backend\modules\document\models;

use common\behaviors\UploadFileBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%document_data}}".
 *
 * @property int $id
 * @property int $document_entity_id
 * @property int $file_id
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property DocumentEntity $entity
 */
class DocumentData extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%document_data}}';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['document_entity_id', 'file_id', 'created_at', 'updated_at'], 'integer'],
      [['description'], 'string'],
      [['document_entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentEntity::className(), 'targetAttribute' => ['document_entity_id' => 'id']],
      [['file'], 'file', 'skipOnEmpty' => false, 'when' => function($model) {
        return empty($model->file_id);
      }, 'whenClient' => 'function (attribute, value) {
      console.log(attribute, value);
                    var fileID = attribute.id.replace("file", "file_id");
                    var fileIdElem = $("#"+fileID);
                          console.log(fileID, fileIdElem);

                    return !value && (!fileIdElem.length || !fileIdElem.val());
                }'],
    ];
  }

  public function behaviors()
  {
    return array_merge(parent::behaviors(), [
      TimestampBehavior::class,
    ]);
  }

  public function uploadFile($index = null)
  {
    $name = sprintf('%sfile', isset($index) ? "[$index]" : "");
	  $this->file = UploadedFile::getInstance($this, $name);
    if($this->file && $this->validate(['file'])) {
      $this->file_id = Yii::$app->filestorage->uploadFromModel($this, $name, self::FILES_DIR);
    }
	 return $this->file_id > 0;
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'document_entity_id' => 'Document Entity ID',
      'file_id' => 'File ID',
      'description' => 'Description',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getDocumentEntity()
  {
    return $this->hasOne(DocumentEntity::class, ['id' => 'document_entity_id']);
  }

  const FILES_DIR = 'documents/files';

  public $file;

  protected $_fileUrl;

  /**
   * @return null|string
   */
  public function getFileUrl()
  {
    if (!$this->_fileUrl) {
      $this->_fileUrl = Yii::$app->filestorage->getFileUrl($this->file_id);
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
      $path = Yii::$app->filestorage->getFilePath($this->file_id);
      $this->_fileSize = $path ? filesize($path) : 0;
    }
    return $this->_fileSize;
  }

  protected $_fileCaption;

  public function getFileCaption()
  {
    if (!$this->_fileCaption) {
      $this->_fileCaption = Yii::$app->filestorage->getFileOriginalName($this->file_id);
    }
    return $this->_fileCaption;
  }
}
