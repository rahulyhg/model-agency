<?php
namespace modules\mod\lib;

/**
 * Class ActiveForm
 * @package modules\mod\lib
 *
 * @method ActiveField field($model, $attribute, $options = [])
 */
class ActiveForm extends \yii\widgets\ActiveForm
{
  public $fieldClass = ActiveField::class;
  public $errorCssClass = 'b-field__has-error';
}