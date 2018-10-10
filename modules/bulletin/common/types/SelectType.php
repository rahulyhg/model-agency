<?php

namespace modules\bulletin\common\types;


class SelectType extends BaseType
{
  public $items = [];

  public function init()
  {
    if(empty($this->rules['in']) && !empty($this->items)) {
      $this->rules['in'] = ['range' => array_keys($this->items)];
    }
    parent::init();
  }

  public function generateValueField($form, $model, $name)
  {
    return parent::generateValueField($form, $model, $name)->widget(\kartik\widgets\Select2::class, [
      'data' => $this->items,
      'options' => ['placeholder' => ''],
      'pluginOptions' => ['allowClear' => true]
    ]);
  }
}