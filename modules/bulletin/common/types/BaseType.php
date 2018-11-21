<?php

namespace modules\bulletin\common\types;

use modules\bulletin\common\models\AttributeVal;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

abstract class BaseType extends BaseObject
{
  public $id;
  public $name;
  public $slug;

  public $rules = [];

  protected $defaultRules = [];

  public $inputOptions = [];

  public function init()
  {
    $this->rules = ArrayHelper::merge($this->defaultRules, $this->rules);
    parent::init();
  }

  /**
   * @param $form \yii\widgets\ActiveForm
   * @param $model \yii\base\DynamicModel
   * @param $name string
   * @param array $options array
   * @return mixed \yii\widgets\ActiveField
   */
  public function generateValueField($form, $model, $name, $options = [])
  {
    return $form->field($model, $name, $options);
  }

  /**
   * @param $form \yii\widgets\ActiveForm
   * @param $model \yii\base\DynamicModel
   * @param $name string
   * @return \yii\widgets\ActiveField
   */
  public function generateValueFieldFrontend($form, $model, $name)
  {
    return $form->field($model, $name);
  }

  /**
   * @return array
   */
  public function getFilterAttributes()
  {
    return [$this->slug];
  }

  /**
   * @return array
   */
  public function getFilterLabels()
  {
    return [$this->slug => $this->name];
  }

  /**
   * @return array
   */
  public function getFilterRules()
  {
    return [];
  }

  public function addFilterFieldWhere($query, $model)
  {
  }

  /**
   * Возвращает значение типа в том виде, который нужен на frontend
   * @param $val
   * @return string
   */
  public abstract function getValue($val) : string;
}