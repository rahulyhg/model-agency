<?php
namespace modules\bulletin\widgets\verticalCard;

use modules\bulletin\common\models\Bulletin;
use yii\base\InvalidConfigException;
use yii\base\Widget;

class VerticalCard extends Widget
{
  /**
   * @var Bulletin
   */
  public $model;

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
      'model' => $this->model
    ]);
  }
}