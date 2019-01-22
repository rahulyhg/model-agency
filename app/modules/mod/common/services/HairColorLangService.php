<?php
/**
 * Created by PhpStorm.
 * User: Oleks
 * Date: 03.01.2019
 * Time: 16:30
 */

namespace modules\mod\common\services;


use modules\mod\common\models\HairColorLang;
use yii\helpers\ArrayHelper;

class HairColorLangService extends HairColorLang
{
  public static function getMap($from, $to)
  {
    return ArrayHelper::map(HairColorLang::find()->all(), $from, $to);
  }
}