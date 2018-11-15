<?php
/**
 * @var $filterForm DynamicForm
 * @var $name
 * @var $items
 */
use modules\bulletin\common\types\DynamicForm;
use yii\helpers\Html;

?>
<div class="b-form-group b-filters__item">
  <span class="b-field-name b-form-group__name"><?= $filterForm->getAttributeLabel($name) ?></span>
  <div class="b-form-group__items scrollbar-outer">
    <?= Html::activeCheckboxList($filterForm, $name, $items, [
      'item' => function ($index, $label, $name, $checked, $value) {
        return '<label class="b-field-check-box b-form-group__item">' .
          Html::checkbox($name, $checked, [
            'value' => $value,
            'class' => 'b-field-check-box__input'
          ]) . '<span class="b-field-check-box__name">'.$label.'</span></label>';
      },
    ]) ?>
  </div>
</div>