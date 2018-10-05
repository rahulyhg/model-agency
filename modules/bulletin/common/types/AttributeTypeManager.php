<?php

namespace modules\bulletin\common\types;


use modules\bulletin\common\models\Attribute;
use modules\bulletin\common\models\AttributeVal;
use modules\bulletin\common\models\Category;
use yii\base\BaseObject;
use yii\base\DynamicModel;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class AttributeTypeManager extends BaseObject
{
  /**
   * @var AttributeVal[]|null
   */
  public $models;

  /**
   * @var DynamicModel
   */
  public $model;

  /**
   * @var BaseType[]
   */
  public $fields = [];

  public function init()
  {
    if ($this->models) {
      $this->models = ArrayHelper::index($this->models, 'attribute_id');
    }

    $tempAttributes = [];
    foreach ($this->fields as $id => $field) {
      if ($this->models && $this->models[$id]) {
        $tempAttributes[$this->nameById($id)] = $this->models[$id]->val;
      } else {
        $tempAttributes[] = $this->nameById($id);
      }
    }

    $this->model = new DynamicModel($tempAttributes);
    foreach ($this->fields as $id => $field) {
      foreach ($field->rules as $key => $value) {
        if (is_array($value)) {
          $this->model->addRule($this->nameById($id), $key, $value);
        } else {
          $this->model->addRule($this->nameById($id), $value);
        }
      }
    }
  }

  /**
   * @param $form \yii\widgets\ActiveForm
   * @return array
   */
  public function generateFields($form)
  {
    $formFields = [];
    foreach ($this->fields as $id => $field) {
      $formFields[] = $field->generateValueField($form, $this->model, $this->nameById($id));
    }
    return $formFields;
  }

  public function getModelsToSave()
  {


    $attributeValModels = [];
    foreach ($this->model->attributes as $key => $value) {
      $id = $this->idByName($key);
      if ($this->models[$id]) {
        $this->models[$id]->val = $value;
        $attributeValModels[] = $this->models[$id];
      } else {
        $attributeValModels[] = new AttributeVal([
          'attribute_id' => $id,
          'val' => $value,
        ]);
      }
    }
    return $attributeValModels;
  }

  protected function idByName($name)
  {
    return str_replace('attr_', '', $name);
  }

  protected function nameById($id)
  {
    return 'attr_' . $id;
  }

  public function loadModel($data)
  {
    return $this->model->load($data);
  }

  public static function createByCategory($categoryId, $models = null)
  {
    $fields = [];
    foreach(Attribute::findByCategory($categoryId) as $attribute){
      $params = \yii\helpers\Json::decode($attribute->type_settings) ? : [];
      $typeClass = $attribute->getTypeClass();
      $fields[$attribute->id] = new $typeClass($params);
    }
    $obj = new self([
      'fields' => $fields,
      'models' => $models,
    ]);
    return $obj;
  }

  //        $dynamicModel = new DynamicModel(compact('price', 'floor_number', 'type', 'is_commission'));
//        $dynamicModel->addRule('price', 'number');
//        $dynamicModel->addRule('price', 'required');
//        $dynamicModel->addRule('floor_number', 'integer', ['min' => 1, 'max' => 50]);
//        $dynamicModel->addRule('floor_number', 'required');
//        $dynamicModel->addRule('type', 'in', ['range' => $types]);
//        $dynamicModel->addRule('is_commission', 'boolean');
}