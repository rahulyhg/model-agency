<?php

namespace modules\block;

use modules\block\common\models\Block;

class Module extends \common\lib\Module
{
  /**
   * @param $key
   * @return null|string
   */
  public static function getBlock($key)
  {
    if($model = Block::findOne(['key' => $key])){
      return $model->content;
    }
    return null;
  }
}