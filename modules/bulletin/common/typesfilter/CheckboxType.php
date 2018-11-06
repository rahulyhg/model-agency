<?php

namespace modules\bulletin\common\typesfilter;


class CheckboxType extends BaseType
{
  protected $defaultRules = [
    'boolean'
  ];

  public function generateValueField($form, $model, $name)
  {
    return parent::generateValueField($form, $model, $name)->checkbox(/*['label' => $this->name]*/);
  }
}