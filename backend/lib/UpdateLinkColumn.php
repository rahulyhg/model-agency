<?php

namespace backend\lib;

use yii\helpers\ArrayHelper;

class UpdateLinkColumn extends \yii\grid\DataColumn
{
  public $idName = 'id';
  public $updateRoute = 'update';

  public function init()
  {
    $this->format = 'raw';
    $name = $this->attribute;
    $updateRoute = $this->updateRoute;
    $idName = $this->idName;
    if(preg_match('/_id$/i', $this->attribute)){
      $idName = $this->attribute;
    }
    if(is_string($this->value)){
      $name = $this->value;
    }
    $this->value = function ($model) use ($name, $updateRoute, $idName) {
      return \yii\helpers\Html::a(ArrayHelper::getValue($model, $name), \yii\helpers\Url::to([$updateRoute, 'id' => ArrayHelper::getValue($model, $idName)]));
    };
    parent::init();
  }
}