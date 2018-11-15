<?php
/**
 * @var $filterForm DynamicForm
 * @var $nameFrom
 * @var $nameTo
 */
use modules\bulletin\common\types\DynamicForm;
use yii\helpers\Html;

?>
<div class="b-range b-filters__item">
  <label class="b-field-number b-range__item">
    <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel($nameFrom)?></span>
    <?= Html::activeTextInput($filterForm, $nameFrom, [
      'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
    ]) ?>
  </label>
  <label class="b-field-number b-range__item">
    <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel($nameTo)?></span>
    <?= Html::activeTextInput($filterForm, $nameTo, [
      'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
    ]) ?>
  </label>
</div>