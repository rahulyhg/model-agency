<?php
namespace modules\lang\widgets\frontendLangSwitcher;

use modules\lang\common\models\Lang;
use yii\base\Widget;

class LangSwitcher extends Widget
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
    $langs = Lang::find()->all();
    return $this->render('index', [
      'elementClass' => $this->elementClass,
      'langs' => $langs
    ]);
  }
}