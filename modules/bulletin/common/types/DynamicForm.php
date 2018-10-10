<?php

namespace modules\bulletin\common\types;


class DynamicForm extends \yii\base\DynamicModel
{
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