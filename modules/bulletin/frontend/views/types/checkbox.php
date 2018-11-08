<?php
/**
 * @var $filterForm DynamicForm
 * @var $name
 */
use modules\bulletin\common\types\DynamicForm;
use yii\helpers\Html;

?>
<?= Html::activeCheckbox($filterForm, $name, [
  'class' => 'b-field-check-box__input',
  'label' => '<span class="b-field-check-box__name">'.$filterForm->getAttributeLabel($name).'</span>',
  'labelOptions' => ['class' => 'b-field-check-box b-filters__row-item']
]) ?>