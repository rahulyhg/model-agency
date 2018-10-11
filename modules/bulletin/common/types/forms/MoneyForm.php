<?php

namespace modules\bulletin\common\types\forms;


use yii\base\Model;

class MoneyForm extends BaseForm
{
  public $isRequired = true;

  public $numberMin;

  public $numberMax;

  public function rules()
  {
    return [
      ['isRequired', 'boolean'],
      [['numberMin', 'numberMax'], 'number'],
      ['numberMax', 'compare', 'compareAttribute' => 'numberMin', 'operator' => '>=',
        'whenClient' => 'function(attribute, value){ return $("#"+attribute.id.replace("max","min")).val(); }',
        'when' => function($model) { return !empty($model->numberMin); },
      ],
    ];
  }

  public function attributeLabels()
  {
    return array_merge(parent::attributeLabels(), [
      'numberMin' => 'Минимальное значение',
      'numberMax' => 'Максимальное значение',
    ]);
  }

  public static function createFromTypeArray($arr, $trArr)
  {
    $params = [
      'isRequired' => false,
    ];
    if (isset($arr['rules'])) {
      foreach ($arr['rules'] as $key => $value) {
        if (is_array($value)) {
          if ($key == 'number') {
            if (isset($value['min'])) {
              $params['numberMin'] = $value['min'];
            }
            if (isset($value['max'])) {
              $params['numberMax'] = $value['max'];
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
    if (is_numeric($this->numberMin) || is_numeric($this->numberMax)) {
      $numberArr = [];
      if (is_numeric($this->numberMin)) {
        $numberArr['min'] = $this->numberMin;
      }
      if (is_numeric($this->numberMax)) {
        $numberArr['max'] = $this->numberMax;
      }
      $arr['rules']['number'] = $numberArr;
    }
    return $arr;
  }
}