<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.10.2018
 * Time: 16:21
 */

namespace modules\bulletin\common\types;


use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

abstract class BaseType extends BaseObject
{
  public $name;

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
   * @return \yii\widgets\ActiveField
   */
  public function generateValueField($form, $model, $name)
  {
    return $form->field($model, $name);
  }
}