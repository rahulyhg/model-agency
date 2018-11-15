<?php
namespace modules\bulletin\widgets\clientCard;

use modules\bulletin\common\models\Bulletin;
use yii\base\InvalidConfigException;
use yii\base\Widget;

class ClientCard extends Widget
{
  /**
   * @var Bulletin
   */
  public $model;

  /**
   * @var string
   */
  public $elementClass = '';

  public function init()
  {
    if( !$this->model instanceof Bulletin ) {
      throw new InvalidConfigException('model property must be an instance of Bulletin');
    }
    parent::init();
  }

  public function run()
  {
    return $this->render('index', [
      'model' => $this->model,
      'elementClass' => $this->elementClass
    ]);
  }
}