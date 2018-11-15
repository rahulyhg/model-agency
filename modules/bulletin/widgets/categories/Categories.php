<?php
namespace modules\bulletin\widgets\categories;

use yii\base\Widget;

class Categories extends Widget
{
  /**
   * @var string
   */
  public $elementClass = '';

  public function init()
  {
    parent::init();
  }

  public function run()
  {
    return $this->render('index', [
      'topLevelCategories' => \modules\bulletin\common\models\Category::getTopLevelCategories(),
      'elementClass' => $this->elementClass
    ]);
  }
}