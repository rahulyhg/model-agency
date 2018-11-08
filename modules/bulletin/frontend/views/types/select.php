<?php
/**
 * @var $filterForm DynamicForm
 * @var $name
 * @var $items
 */
use modules\bulletin\common\types\DynamicForm;
use yii\helpers\Html;

?>
<label class="b-field-select b-filters__field-select">
  <span class="b-field-name b-field-select__name"><?= $filterForm->getAttributeLabel($name)?></span>
  <?= Html::activeDropDownList($filterForm, $name, $items, [
    'class' => 'b-select2 b-field-select__select2',
    'data-select2-filter' => true,
    'prompt' => ''
  ]) ?>
</label>