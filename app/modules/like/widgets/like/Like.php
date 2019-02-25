<?php
namespace modules\like\widgets\like;

use Codeception\Exception\ConfigurationException;
use yii\base\Widget;

class Like extends Widget
{
  public $options;
  public $entityId;

  public function init()
  {
    parent::init();
    if(!$this->entityId) {
      throw new ConfigurationException('entityId must be define!');
    }
  }

  public function run()
  {
    $count = \modules\like\common\models\Like::find()->where(['entity_id' => $this->entityId])->count();
    return $this->render('index', [
      'attributes' => $this->options,
      'count' => $count,
      'entityId' => $this->entityId
    ]);
  }
}