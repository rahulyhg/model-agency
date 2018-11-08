<?php

namespace modules\bulletin\common\types;


class DynamicForm extends \yii\base\DynamicModel
{
  public $formName;

  public function formName()
  {
    if($this->formName)
      return $this->formName;
    return parent::formName();
  }

  protected $_labels;

  public function setAttributeLabels($labels)
  {
    $this->_labels = $labels;
  }

  public function getAttributeLabel($name)
  {
    return isset($this->_labels[$name]) ? $this->_labels[$name] : $name;
  }
}