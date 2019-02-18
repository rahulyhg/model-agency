<?php
namespace modules\mod\widgets\popularModels;

use modules\mod\common\models\Mod;
use yii\base\Widget;

class PopularModels extends Widget
{
  /**
   * @var int Count of models
   */
  public $count = 9;

  /**
   * @var string Class for wrapper (BEM element class)
   */
  public $elementClass = '';

  public function init()
  {
    parent::init();
  }

  public function run()
  {
    $mods = Mod::find()->orderBy('created_at DESC')->limit($this->count)->all();
    return $this->render('index', [
      'count' => $this->count,
      'elementClass' => $this->elementClass,
      'mods' => $mods
    ]);
  }
}