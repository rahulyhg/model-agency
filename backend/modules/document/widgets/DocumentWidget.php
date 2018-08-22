<?php

namespace backend\modules\document\widgets;


use backend\modules\document\models\DocumentData;
use backend\modules\document\models\DocumentEntity;
use backend\modules\document\traits\ModuleTrait;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Json;

class DocumentWidget extends Widget
{
  use ModuleTrait;
  /**
   * @var \yii\db\ActiveRecord|null Widget model
   */
  public $model;

  /**
   * @var string pjax container id
   */
  public $pjaxContainerId;

  /**
   * @var string entity id attribute
   */
  public $entityIdAttribute = 'id';

  /**
   * @var string hash(crc32) from class name of the widget model
   */
  protected $entity;

  /**
   * @var int primary key value of the widget model
   */
  protected $entityId;

  /**
   * @var string encrypted entity
   */
  protected $encryptedEntity;

  /**
   * @var string document wrapper tag id
   */
  protected $documentWrapperId;

  /**
   * Initializes the widget params.
   */
  public function init()
  {
    parent::init();

    if (empty($this->model)) {
      throw new InvalidConfigException('The "model" property must be set.');
    }

    if (empty($this->pjaxContainerId)) {
      $this->pjaxContainerId = 'document-pjax-container-' . $this->getId();
    }

    if (empty($this->model->{$this->entityIdAttribute})) {
      throw new InvalidConfigException('The "entityIdAttribute" value for widget model cannot be empty.');
    }

    $this->entity = hash('crc32', get_class($this->model));
    $this->entityId = $this->model->{$this->entityIdAttribute};

    $this->encryptedEntity = $this->getEncryptedEntity();
    $this->documentWrapperId = $this->entity . $this->entityId;

  }

  /**
   * Executes the widget.
   *
   * @return string the result of widget execution to be outputted
   */
  public function run()
  {
    $model = DocumentEntity::findOne(['entity' => $this->entity, 'entity_id' => $this->entityId]);
    if($model) {
      $models = $model->documentDatas;
    }
    if(empty($models)) {
      $models = [new DocumentData()];
    }

    return $this->render('@backend/modules/document/widgets/views/index', [
      'models' => $models,
      'encryptedEntity' => $this->encryptedEntity,
      'pjaxContainerId' => $this->pjaxContainerId,
      'documentWrapperId' => $this->documentWrapperId,
    ]);
  }

  /**
   * Get encrypted entity
   *
   * @return string
   */
  protected function getEncryptedEntity()
  {
    return utf8_encode(Yii::$app->getSecurity()->encryptByKey(Json::encode([
      'entity' => $this->entity,
      'entity_id' => $this->entityId,
    ]), $this->getModule()->id));
  }
}