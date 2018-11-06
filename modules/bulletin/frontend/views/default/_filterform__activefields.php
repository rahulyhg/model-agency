<?php
/**
 * @var $filterForm FilterForm
 */
use modules\bulletin\frontend\forms\FilterForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
//              'action' => ['/bulletin/default/category'],
  'method' => 'get',
  'options' => [
    'id' => 'filters-form',
    'class' => 'b-filters b-header__filters'
  ]
]); ?>
  <div class="b-filters__col">
    <div class="b-form-group b-filters__item">

      <span class="b-field-name b-form-group__name"><?= $filterForm->getAttributeLabel('communications') ?></span>

      <div class="b-form-group__items scrollbar-outer">
        <?= $form->field($filterForm, 'communications')->label(false)->checkboxList($filterForm->communicationsVariants(), [
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

    <label for="<?= \yii\helpers\Html::getInputId($filterForm, 'bathroom') ?>" class="b-field-select b-filters__field-select">
      <span class="b-field-name b-field-select__name"><?= $filterForm->getAttributeLabel('bathroom')?></span>
      <?= $form->field($filterForm, 'bathroom')->label(false)->dropDownList($filterForm->bathroomVariants(), [
        'class' => 'b-select2 b-field-select__select2',
        'data-select2-non-search' => true,
      ]) ?>
    </label>
  </div>

  <div class="b-filters__col">
    <div class="b-range b-filters__item">
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('priceFrom')?></span>
        <?= $form->field($filterForm, 'priceFrom')->label(false)->textInput([
          'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
        ]) ?>
      </label>
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('priceTo')?></span>
        <?= $form->field($filterForm, 'priceTo')->label(false)->textInput([
          'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
        ]) ?>
      </label>
    </div>
    <div class="b-range b-filters__item">
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('priceFrom')?></span>
        <input class="b-field-number__input" type="number" min="0" name="input">
      </label>
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('priceTo')?></span>
        <input class="b-field-number__input" type="number" min="0" name="input">
      </label>
    </div>
  </div>

  <div class="b-filters__col">
    <div class="b-range b-filters__item">
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('priceFrom')?></span>
        <?= $form->field($filterForm, 'floorFrom')->label(false)->textInput([
          'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
        ]) ?>
      </label>
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('priceTo')?></span>
        <?= $form->field($filterForm, 'floorTo')->label(false)->textInput([
          'type' => 'number', 'min' => 0, 'class' => 'b-field-number__input',
        ]) ?>
      </label>
    </div>
    <div class="b-range b-filters__item">
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('floorFrom')?></span>
        <input class="b-field-number__input" type="number" min="0" name="input">
      </label>
      <label class="b-field-number b-range__item">
        <span class="b-field-name b-field-number__name"><?= $filterForm->getAttributeLabel('floorTo')?></span>
        <input class="b-field-number__input" type="number" min="0" name="input">
      </label>
    </div>

    <?= $form->field($filterForm, 'withCommission')->checkbox() ?>
    <label class="b-field-check-box b-filters__row-item">
      <input class="b-field-check-box__input" type="checkbox" name="checkbox">
      <span class="b-field-check-box__name"><?= $filterForm->getAttributeLabel('withCommission') ?></span>
    </label>
  </div>

  <button type="submit" class="b-button-second b-filters__apply">
    <span class="b-button-second__value">Применить</span>
  </button>
<?php ActiveForm::end() ?>