<?php

namespace modules\bulletin\common\types;


class IntegerType
{
  public $name;

  public $rules = [
    [['type_id'], 'required'],
    [['type_id'], 'integer'],
  ];

  public $inputOptions = [];

  public function generateValueField($form, $model, $name)
  {

  }
}