<?php

namespace modules\bulletin\common\types;


class CheckboxType extends BaseType
{
  public function generateValueField($form, $model, $name)
  {
    return parent::generateValueField($form, $model, $name)->checkbox();
  }
}