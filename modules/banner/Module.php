<?php

namespace modules\banner;

use modules\banner\common\models\Banner;

class Module extends \common\lib\Module
{
  /**
   * @param $position
   * @return null|string
   */
  public static function getBanner($position)
  {
    if ($model = Banner::findOne(['position' => $position])) {
      return $model->content;
    }
    return null;
  }
}