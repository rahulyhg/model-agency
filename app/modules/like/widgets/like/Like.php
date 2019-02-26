<?php
namespace modules\like\widgets\like;

use Codeception\Exception\ConfigurationException;
use yii\base\Widget;

class Like extends Widget
{
  public $options;
  public $entityId;
  public $entityClass;
  protected $entity;

  public function init()
  {
    parent::init();
    if(!$this->entityId) {
      throw new ConfigurationException('entityId must be define!');
    }
    if(!$this->entityClass) {
      throw new ConfigurationException('entityClass must be define!');
    }
    $this->entity = hash('crc32', $this->entityClass);
  }

  public function run()
  {
    $count = \modules\like\common\models\Like::find()->where(['entity_id' => $this->entityId, 'entity' => $this->entity])->count();
    return $this->render('index', [
      'attributes' => $this->options,
      'count' => $count,
      'entityId' => $this->entityId,
      'entity' => $this->entity
    ]);
  }
}