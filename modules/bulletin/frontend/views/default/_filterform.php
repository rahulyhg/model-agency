<?php
/**
 * @var $filterForm FilterForm
 * @var $category string
 */
use modules\bulletin\frontend\forms\FilterForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
  'action' => ['/bulletin/default/category', 'id' => $category],
  'method' => 'get',
  'options' => [
    'id' => 'filters-form',
    'class' => 'b-filters b-header__filters'
  ]
]); ?>
  <div class="b-filters__col">
    <div class="b-range b-filters__item">
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('priceFrom')?></span>
        <?= Html::activeTextInput($filterForm, 'priceFrom', [
          'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
        ]) ?>
      </label>
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('priceTo')?></span>
        <?= Html::activeTextInput($filterForm, 'priceTo', [
          'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
        ]) ?>
      </label>
    </div>
    <?= Html::activeCheckbox($filterForm, 'withCommission', [
      'class' => 'b-field-check-box__input',
      'label' => '<span class="b-field-check-box__name">'.$filterForm->getAttributeLabel('withCommission').'</span>',
      'labelOptions' => ['class' => 'b-field-check-box b-filters__row-item']
    ]) ?>
  </div>

  <div class="b-filters__col">
    <div class="b-range b-filters__item">
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('floorFrom')?></span>
        <?= Html::activeTextInput($filterForm, 'floorFrom', [
          'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
        ]) ?>
      </label>
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('floorTo')?></span>
        <?= Html::activeTextInput($filterForm, 'floorTo', [
          'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
        ]) ?>
      </label>
    </div>
  </div>

  <div class="b-filters__col">
    <div class="b-form-group b-filters__item">

      <span class="b-field-name b-form-group__name"><?= $filterForm->getAttributeLabel('communications') ?></span>

      <div class="b-form-group__items scrollbar-outer">
        <?= Html::activeCheckboxList($filterForm, 'communications', $filterForm->communicationsVariants(), [
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
  </div>

  <div class="b-filters__col">

    <label class="b-field-select b-filters__field-select">
      <span class="b-field-name b-field-select__name"><?= $filterForm->getAttributeLabel('bathroom')?></span>
      <?= Html::activeDropDownList($filterForm, 'bathroom', $filterForm->bathroomVariants(), [
        'class' => 'b-select2 b-field-select__select2',
        'data-select2-filter' => true,
        'prompt' => ''
      ]) ?>
    </label>
  </div>

  <button type="submit" class="b-button-second b-filters__apply">
    <span class="b-button-second__value">Применить</span>
  </button>
<?php ActiveForm::end() ?>