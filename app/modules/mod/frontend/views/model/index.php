<?php
/**
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $hairColorMap array
 * @var $showFilterForm boolean
 * @var $filterForm \modules\mod\frontend\forms\ModelFilterForm
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use modules\mod\frontend\forms\ModelFilterForm;

$this->title = 'Наши модели';

$this->registerJs(<<<JS
$(document).ready(function () {
  $('#hair_color').select2({
      "minimumResultsForSearch": -1,
      "searchInputPlaceholder": 'Поиск...',
      'language': {
          'noResults': function () {
              return "No results to search";
          }
      }
  });

  $('select').on('select2:open', function (e) {
      $('.select2-results__options').scrollbar().parent().addClass('scrollbar-outer');
      $('.select2-search input').prop('focus', false);
  });

  $('[data-select2-non-search]').select2({
      'minimumResultsForSearch': -1
  });
  
  $('[data-select2-search]').select2();
});

$(document).ready(e => {

  $('#search-location').select2({
      "searchInputPlaceholder": 'Введите название населенного пункта',
      "language": {
          "noResults": function () {
              return "Ничего не найдено";
          }
      }
  });

  $('select').on('select2:open', function (e) {
      $('.select2-results__options').scrollbar().parent().addClass('scrollbar-outer');
      $('.select2-search input').prop('focus', false);
  });

  $('[data-select2-non-search]').select2({
      "minimumResultsForSearch": -1
  });
  
  $('[data-select2-search]').select2();

})
JS
);
// change text on open filter button
$this->registerJs(<<<JS

$('#modelFilter').on('show.bs.collapse', (e) => {
  $('#openFilterBtnTxt').html('Закрыть фильтр');
})
$('#modelFilter').on('hide.bs.collapse', (e) => {
  $('#openFilterBtnTxt').html('Открыть фильтр');
})

JS
);
// sort form submit on change
$this->registerJs(<<<JS

$('#sort-model').change((e) => {
  $('#sort-form').submit();
})

JS
);
?>
<section class="b-section b-main__item">
  <header class="b-section__header">
    <h1 class="b-title b-section__header-title"><span class="b-title__texts b-title__texts_line-first"><span
            class="b-title__text-first">Наши</span><span class="b-title__text-second">модели</span></span></h1>
    <div class="b-section__header-actions">
      <div class="b-actions-line">
        <div class="b-actions-line__item">
          <?php $sortForm = ActiveForm::begin([
            'method' => 'GET',
            'options' => [
              'class' => 'b-sort-form',
              'id' => 'sort-form'
            ]
          ]) ?>
          <div class="b-sort-form__title">Сортировать по:</div>
          <?= $sortForm->field($filterForm, 'orderBy', ['template' => '{input}', 'options' => ['tag' => false]])
            ->label(false)
            ->dropDownList(ModelFilterForm::getOrderMap(), [
              'id' => 'sort-model',
              'class' => 'b-sort-form__select',
              'placeholder' => 'Выберите...',
            ]); ?>
          <?php ActiveForm::end() ?>
        </div>
        <div class="b-actions-line__item">
          <button class="b-button b-button_first"
                  data-toggle="collapse"
                  href="#modelFilter"
                  role="button"
                  aria-expanded="false"
                  aria-controls="collapseExample">
            <span class="b-button__texts">
              <i class="b-button__icon fas fa-search"></i>
              <span class="b-button__text-first" id="openFilterBtnTxt">Открыть фильтр</span>
            </span>
          </button>
        </div>
      </div>
    </div>
  </header>
  <div class="b-section__main collapse <?= $showFilterForm ? 'in' : '' ?>" id="modelFilter">
    <?php $form = ActiveForm::begin([
      'method' => 'GET',
      'options' => ['class' => 'b-filter-form']
    ]) ?>
    <div class="b-filter-form__items">
      <div class="b-double-field b-filter-form__item">
        <label class="b-double-field__label">
          <div class="b-double-field__title">
            <i class="b-double-field__icon b-double-field__icon_focus-first fas fa-birthday-cake"></i>
            <span class="b-double-field__title-text">Возраст</span>
          </div>
          <div class="b-double-field__wrap">
            <?= $form->field($filterForm, 'age_from', ['template' => '{input}', 'options' => ['tag' => false]])
              ->label(false)
              ->textInput([
                'class' => 'b-double-field__input-1',
                'placeholder' => 'от',
                'value' => 18,
                'min' => 18,
                'max' => 99
              ]); ?>
            <?= $form->field($filterForm, 'age_to', ['template' => '{input}', 'options' => ['tag' => false]])
              ->label(false)
              ->textInput([
                'class' => 'b-double-field__input-2',
                'placeholder' => 'до',
                'min' => 18,
                'max' => 99
              ]); ?>
          </div>
        </label>
      </div>
      <div class="b-double-field b-filter-form__item">
        <label class="b-double-field__label">
          <div class="b-double-field__title"><i
                class="b-double-field__icon b-double-field__icon_focus-first fas fa-arrows-alt-v"></i><span
                class="b-double-field__title-text">Рост (см)</span></div>
          <div class="b-double-field__wrap">
            <?= $form->field($filterForm, 'height_from', ['template' => '{input}', 'options' => ['tag' => false]])
              ->label(false)
              ->textInput([
                'class' => 'b-double-field__input-1',
                'placeholder' => 'от',
                'min' => 0,
              ]); ?>
            <?= $form->field($filterForm, 'height_to', ['template' => '{input}', 'options' => ['tag' => false]])
              ->label(false)
              ->textInput([
                'class' => 'b-double-field__input-2',
                'placeholder' => 'до',
                'min' => 0,
              ]); ?>
          </div>
        </label>
      </div>
      <div class="b-double-field b-filter-form__item">
        <label class="b-double-field__label">
          <div class="b-double-field__title"><i
                class="b-double-field__icon b-double-field__icon_focus-first fas fa-weight"></i><span
                class="b-double-field__title-text">Вес (кг)</span></div>
          <div class="b-double-field__wrap">
            <?= $form->field($filterForm, 'weight_from', ['template' => '{input}', 'options' => ['tag' => false]])
              ->label(false)
              ->textInput([
                'class' => 'b-double-field__input-1',
                'placeholder' => 'от',
                'min' => 0,
              ]); ?>
            <?= $form->field($filterForm, 'weight_to', ['template' => '{input}', 'options' => ['tag' => false]])
              ->label(false)
              ->textInput([
                'class' => 'b-double-field__input-2',
                'placeholder' => 'до',
                'min' => 0,
              ]); ?>
          </div>
        </label>
      </div>
      <div class="b-field-select b-field-select_icon b-filter-form__item">
        <label class="b-field-select__label"><span class="b-field-select__title">Цвет волос</span>
          <div class="b-field__wrap">

            <?= $form->field($filterForm, 'hair_color_id', ['template' => '{input}', 'options' => ['tag' => false]])
              ->label(false)
              ->dropDownList($hairColorMap, [
                'id' => 'hair_color',
                'class' => 'b-field-select__select2',
                'placeholder' => 'Введите...',
              ]); ?>
            <i class="b-field-select__icon b-field-select__icon_focus-first fas fa-female"></i>
          </div>
        </label>
      </div>
      <div class="b-field b-filter-form__item">
        <label class="b-field__label"><span class="b-field__title">Полное имя</span>
          <div class="b-field__wrap">
            <?= $form->field($filterForm, 'full_name', ['template' => '{input}', 'options' => ['tag' => false]])
              ->label(false)
              ->textInput([
                'class' => 'b-field__input b-field__input_icon',
                'placeholder' => 'Введите...',
              ]); ?>
            <i class="b-field__icon b-field__icon_focus-first fas fa-search"></i>
          </div>
        </label>
      </div>
      <button class="b-button b-button_first b-filter-form__item b-filter-form__item_submit" type="submit"><span
            class="b-button__texts"><span class="b-button__text-first">Поиск</span></span></button>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
  <?php if ($dataProvider->models) : ?>
    <div class="b-our-models b-section__main">
      <div class="b-our-models__items">
        <?php foreach ($dataProvider->models as $model) :
          /**
           * @var $model \modules\mod\common\models\Mod
           */
          ?>
          <a class="b-our-model b-our-models__item" href="<?= Url::to(['/mod/model/view', 'id' => $model->id]) ?>">
            <div class="b-our-model__box"
                 style="background-image: url('<?= $model->modUser->photoUrl ?: Yii::$app->theme->getAssetsUrl($this) . '/img/default-model-photo.jpg' ?>')">
              <img class="b-our-model__img"
                   alt="<?= "{$model->full_name}" ?>"
                   src="<?= $model->modUser->photoUrl ?: Yii::$app->theme->getAssetsUrl($this) . '/img/default-model-photo.jpg' ?>">
              <h2 class="b-our-model__name"><?= "{$model->full_name}" ?></h2>
              <div class="b-our-model__id"><?= $model->id ?></div>
            </div>
            <div class="b-our-model__footer">
              <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
                <div class="b-like__value">1447</div>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php else : ?>
    <div class="b-section__main">
      <p>К сожалению мы Вам не можем ничего предложить. Попробуйте изменить параметры.</p>
    </div>
  <?php endif; ?>
</section>
