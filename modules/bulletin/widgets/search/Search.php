<?php

namespace modules\bulletin\widgets\search;


use modules\bulletin\widgets\search\models\SearchForm;
use yii\base\Widget;

class Search extends Widget
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
      'model' => new SearchForm(),
      'elementClass' => $this->elementClass
    ]);
  }
}