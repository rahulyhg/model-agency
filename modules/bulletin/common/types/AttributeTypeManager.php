<?php

namespace modules\bulletin\common\types;


use yii\base\BaseObject;
use yii\base\DynamicModel;

class AttributeTypeManager extends BaseObject
{
  public $fields;

  public function init()
  {
    $types = [
      1 => 'Квартира',
      2 => 'Часть квартиры',
      3 => 'Комната',
    ];
    $this->fields = [
      '1' => [
        'rules' => [
          'number',
          'required',
        ],
      ],
      '2' => [
        'rules' => [
          'integer' => ['min' => 1, 'max' => 50],
          'required',
        ],
      ],
      '3' => [
        'rules' => [
          'in' => ['range' => $types],
        ],
        'items' => $types,
      ],
      '4' => [
        'rules' => [
          'boolean'
        ]
      ],
    ];

    foreach ($this->fields as $key => $field) {
      $this->attsNames[$key] = 'attr_' . $key;
    }
    $dynamicModel = new DynamicModel($this->attsNames);
    foreach ($this->fields as $id => $field) {
      foreach ($field['rules'] as $key => $value)
        if (is_array($value)) {
          $dynamicModel->addRule($this->attsNames[$id], $key, $value);
        } else {
          $dynamicModel->addRule($this->attsNames[$id], $value);
        }
    }

    $this->model = $dynamicModel;
  }

  protected $attsNames = [];

  /**
   * @var DynamicModel
   */
  public $model;

  /**
   * @param $form \yii\widgets\ActiveForm
   * @return array
   */
  public function generateFields($form)
  {
    $formFields = [];
    foreach ($this->fields as $id => $field) {
      switch ($id) {
        case '1' :
          $formFields[] = $form->field($this->model, $this->attsNames[$id])->textInput();
          break;
        case '2' :
          $formFields[] = $form->field($this->model, $this->attsNames[$id])->textInput();
          break;
        case '3' :
          $formFields[] = $form->field($this->model, $this->attsNames[$id])->widget(\kartik\widgets\Select2::class, [
            'data' => $field['items'],
            'options' => ['placeholder' => ''],
            'pluginOptions' => ['allowClear' => true]
          ]);;
          break;
        case '4' :
          $formFields[] = $form->field($this->model, $this->attsNames[$id])->checkbox();
          break;
      }
    }
    return $formFields;
  }

  public function getIdByName($name)
  {
    foreach($this->attsNames as $key => $value){
      if($name == $value)
        return $key;
    }
    throw new \HttpInvalidParamException("Attribute with name '$name' doesn't exist");
  }

  public function getNameById($id)
  {
    return $this->attsNames[$id];
  }

  //        $dynamicModel = new DynamicModel(compact('price', 'floor_number', 'type', 'is_commission'));
//        $dynamicModel->addRule('price', 'number');
//        $dynamicModel->addRule('price', 'required');
//        $dynamicModel->addRule('floor_number', 'integer', ['min' => 1, 'max' => 50]);
//        $dynamicModel->addRule('floor_number', 'required');
//        $dynamicModel->addRule('type', 'in', ['range' => $types]);
//        $dynamicModel->addRule('is_commission', 'boolean');
}