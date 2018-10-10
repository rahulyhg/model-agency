<?php

namespace modules\bulletin\common\types\forms;


use yii\base\Model;

class IntegerForm extends BaseForm
{
  public $isRequired = true;

  public $integerMin;

  public $integerMax;

  public function rules()
  {
    return [
      ['isRequired', 'boolean'],
      [['integerMin', 'integerMax'], 'integer'],
      ['integerMax', 'compare', 'compareAttribute' => 'integerMin', 'operator' => '>=',
        'whenClient' => 'function(attribute, value){ return $("#"+attribute.id.replace("max","min")).val(); }',
        'when' => function($model) { return !empty($model->integerMin); },
      ],
    ];
  }

  public static function createFromTypeArray($arr, $trArr)
  {
    $params = [
      'isRequired' => false,
    ];
    if (isset($arr['rules'])) {
      foreach ($arr['rules'] as $key => $value) {
        if (is_array($value)) {
          if ($key == 'integer') {
            if (isset($value['min'])) {
              $params['integerMin'] = $value['min'];
            }
            if (isset($value['max'])) {
              $params['integerMax'] = $value['max'];
            }
          }
        } else {
          if ($value == 'required') {
            $params['isRequired'] = true;
          }
        }
      }
    }
    return new self($params);
  }

  public function toTypeArray()
  {
    $arr = [];
    if ($this->isRequired) {
      $arr['rules'][] = 'required';
    }
    if (is_numeric($this->integerMin) || is_numeric($this->integerMax)) {
      $integerArr = [];
      if (is_numeric($this->integerMin)) {
        $integerArr['min'] = $this->integerMin;
      }
      if (is_numeric($this->integerMax)) {
        $integerArr['max'] = $this->integerMax;
      }
      $arr['rules']['integer'] = $integerArr;
    }
    return $arr;
  }
}