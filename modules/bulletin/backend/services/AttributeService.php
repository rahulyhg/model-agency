<?php

namespace modules\bulletin\backend\services;


use modules\bulletin\common\models\AttributeType;

class AttributeService
{
  public function getTypeModel($typeId, $typeArray = null, $trTypeArray = null)
  {
    $typeModel = null;
    if($typeFormClass = AttributeType::getFormClass($typeId)) {
      if(is_array($typeArray) && is_array($trTypeArray)) {
        $typeModel = call_user_func([$typeFormClass, 'createFromTypeArray'], $typeArray, $trTypeArray);
      } else {
        $typeModel = new $typeFormClass;
      }
    }
    return $typeModel;
  }
}