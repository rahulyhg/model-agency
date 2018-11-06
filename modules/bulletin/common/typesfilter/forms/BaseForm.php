<?php

namespace modules\bulletin\common\typesfilter\forms;


use ReflectionClass;

abstract class BaseForm extends \yii\base\Model
{
  /**
   * @param $arr
   * @param $trArr
   * @return static
   */
  public static function createFromTypeArray($arr, $trArr)
  {
    return new static();
  }

  /**
   * @return array
   */
  public function toTypeArray()
  {
    return [];
  }

  /**
   * @return array
   */
  public function toTrTypeArray()
  {
    return [];
  }

  protected $_viewName;

  public function getViewName()
  {
    if($this->_viewName)
      return $this->_viewName;
    $reflector = new ReflectionClass($this);
    return $this->_viewName = strtolower(str_replace('Form', '', $reflector->getShortName()));
  }

  public function attributeLabels()
  {
    $attributeLabels = [];
    if($this->hasProperty('isRequired')){
      $attributeLabels['isRequired'] = 'Обязательное поле';
    }
    return $attributeLabels;
  }
}