<?php
/**
 * @var $this \yii\web\View
 * @var $modUser \modules\mod\common\models\ModUser
 * @var $model \modules\mod\common\models\Mod
 * @var $images \modules\mod\common\models\ModImage[]
 */

use \yii\widgets\ActiveForm;
use \yii\helpers\Url;

$this->title = "{$model->full_name} - Моя галерея";

$this->registerJs(<<<JS
$(document).ready(function () {
  $('#country').select2({
      "searchInputPlaceholder": 'Enter the name of the settlement',
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

  new PrevUploadImg({
      parent: '.b-upload',
      input: '.b-upload__input',
      preview: '.b-upload__preview',
      maxSize: 2,
      extensions: ['png', 'jpg', 'jpeg']
  }, () => {
      console.log('example callBack')
  })

  new ActiveInHover({
      items: '.b-menu__items',
      item: '.b-menu__item',
      activeClass: 'b-menu__item_active'
  })

  new ActiveInHover({
      items: '.b-tabs__items',
      item: '.b-tabs__item',
      activeClass: 'b-tabs__item_line-first'
  })

  new ToggleTrigger({
      items: '.b-toggle__items',
      item: '.b-toggle__item',
      activeClass: 'b-toggle__item_active'
  }, () => {
      $('.b-main').toggleClass('b-main_sm-scroll-lock')
      $('.b-main').toggleClass('b-main_sm-transparent')
      $('.b-content').toggleClass('b-content_sm-blackout')
      $('.b-page__sidebar').toggleClass('b-page__sidebar_sm-open')
      $('.b-page__content').toggleClass('b-page__content_sm-shift')                
  })

  autosize(document.querySelectorAll('[data-textarea-autosize]'))

})
JS
);
?>
<section class="b-section b-main__item">
  <header class="b-section__header">
    <h1 class="b-title b-section__header-title">
      <span class="b-title__texts b-title__texts_line-first">
        <span class="b-title__text-first"><?= $model->full_name ?></span>
      </span>
    </h1>
    <div class="b-tabs b-section__header-tabs">
      <ul class="b-tabs__items">
        <li class="b-tabs__item">
          <a class="b-tabs__item-link" href="<?= Url::to(['/mod/profile/model/index']) ?>">
            <span class="b-tabs__texts">
              <span class="b-tabs__text-first">Основная</span>
              <span class="b-tabs__text-second">информация</span>
            </span>
          </a>
        </li>
        <li class="b-tabs__item b-tabs__item_line-first">
          <a class="b-tabs__item-link" href="<?= Url::to(['/mod/profile/model/photo']) ?>">
            <span class="b-tabs__texts">
              <span class="b-tabs__text-second">Моя</span>
              <span class="b-tabs__text-first">галерея</span>
            </span>
          </a>
        </li>
        <!--<li class="b-tabs__item">
          <a class="b-tabs__item-link" href="cabinet-model-payments.html">
            <span class="b-tabs__texts">
              <span class="b-tabs__text-second">My</span>
              <span class="b-tabs__text-first">payments</span>
            </span>
          </a>
        </li>-->
      </ul>
    </div>
  </header>
  <div class="b-cabinet b-section__main">
    <div class="b-cabinet__photos">
      <?php foreach ($images as $image) :
        /**
         * @var $image \modules\mod\common\models\ModImage
         */ ?>
        <div class="b-cabinet-photo b-cabinet__photo">
          <div class="b-cabinet-photo__box"><img class="b-cabinet-photo__img" alt="julia bogdanova" src="<?= $image->url ?>"></div>
          <div class="b-cabinet-photo__footer">
            <div class="b-like b-cabinet-photo__like">
              <i class="b-like__icon fas fa-heart"></i>
              <div class="b-like__value">1447</div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <br>
    <br>

    <?php $form = ActiveForm::begin(); ?>
      <label class="b-add-photos b-cabinet__add-photos">
        <?= $form->field($model, 'images[]', ['template' => '{input}', 'options' => ['tag' => false]])
          ->label(false)
          ->fileInput([
            'class' => 'b-add-photos__input'
          ]); ?>
      </label>
      <button class="b-button b-button_first b-cabinet__submit">
        <span class="b-button__texts">
          <span class="b-button__text-first">Загрузить фото</span>
        </span>
      </button>
    <?php ActiveForm::end(); ?>
  </div>
</section>