<?php

namespace modules\mod\common\services;


use modules\mod\common\models\EyesColorLang;
use yii\helpers\ArrayHelper;

class EyesColorLangService extends EyesColorLang
{
  public static function getMap($from, $to)
  {
    return ArrayHelper::map(EyesColorLang::find()->all(), $from, $to);
  }
}