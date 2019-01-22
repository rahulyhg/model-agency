<?php
/**
 * @var $this \yii\web\View
 * @var $modUser \modules\mod\common\models\ModUser
 * @var $model \modules\mod\common\models\Mod
 */
use \modules\mod\lib\ActiveForm;

$this->title = "{$model->first_name} {$model->last_name} - Profile";

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
    <h1 class="b-title b-section__header-title"><span class="b-title__texts b-title__texts_line-first"><span
            class="b-title__text-first"><?= $model->first_name ?></span><span class="b-title__text-second"><?= $model->last_name ?></span></span></h1>
    <div class="b-tabs b-section__header-tabs">
      <ul class="b-tabs__items">
        <li class="b-tabs__item b-tabs__item_line-first">
          <a class="b-tabs__item-link" href="cabinet-model-basic.html">
            <span class="b-tabs__texts">
              <span class="b-tabs__text-first">Basic</span>
              <span class="b-tabs__text-second">data</span>
            </span>
          </a>
        </li>
        <!--<li class="b-tabs__item"><a class="b-tabs__item-link" href="cabinet-model-photos.html">
            <span class="b-tabs__texts">
              <span class="b-tabs__text-second">My</span>
              <span class="b-tabs__text-first">photos</span>
            </span>
          </a>
        </li>
        <li class="b-tabs__item">
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
    <?php $form = ActiveForm::begin(['options' => ['class' => 'b-cabinet__form']]) ?>
      <div class="b-cabinet__form-inner">
        <?= $form->field($model, 'first_name', ['options' => ['class' => 'b-cabinet__form-field']])->icon('fas fa-user-ninja')->textInput([
          'placeholder' => 'First name',
        ]) ?>
        <?= $form->field($model, 'last_name', ['options' => ['class' => 'b-cabinet__form-field']])->icon('fas fa-user-ninja')->textInput([
          'placeholder' => 'Last name',
        ]) ?>
        <?= $form->field($model, 'middle_name', ['options' => ['class' => 'b-cabinet__form-field']])->icon('fas fa-user-ninja')->textInput([
          'placeholder' => 'Middle name',
        ]) ?>
        <?= $form->field($model, 'age', ['options' => ['class' => 'b-cabinet__form-field']])->icon('fas fa-birthday-cake')->textInput([
          'placeholder' => 'Age',
        ]) ?>
        <?= $form->field($modUser, 'phone', ['options' => ['class' => 'b-cabinet__form-field']])->icon('fas fa-mobile-alt')->textInput([
          'placeholder' => 'Phone number',
        ]) ?>
        <?= $form->field($modUser, 'email', ['options' => ['class' => 'b-cabinet__form-field']])->icon('fas fa-mobile-alt')->textInput([
          'placeholder' => 'Email',
        ]) ?>
        <?= $form->field($modUser, 'newPassword', ['options' => ['class' => 'b-cabinet__form-field']])->icon('fas fa-mobile-alt')->passwordInput([
          'placeholder' => 'New password',
        ]) ?>
        <?= $form->field($modUser, 'passwordRepeat', ['options' => ['class' => 'b-cabinet__form-field']])
          ->title('Confirm password')
          ->icon('fas fa-mobile-alt')
          ->passwordInput([
            'placeholder' => 'Confirm password',
          ]) ?>
      </div>
      <div class="b-upload b-cabinet__form-upload">
        <div class="b-upload__header"><span class="b-upload__title">Main photo</span>
          <label class="b-upload__label">
            <div class="b-link b-upload__link">
              <i class="b-link__icon fas fa-upload"></i>
              <span class="b-link__texts b-link__texts_underline">
                <span class="b-link__text-first">Upload </span>
                <span class="b-link__text-second">new</span>
              </span>
            </div>
            <?= $form->field($modUser, 'photoFile')->title(false)->fileInput([
                'class' => 'b-upload__input'
            ]) ?>
          </label>
        </div>
        <a class="b-upload__preview"
           href="<?= $modUser->photoUrl ?: Yii::$app->theme->getAssetsUrl($this) . '/img/default-model-photo.jpg' ?>"
           style="background-image: url('<?= $modUser->photoUrl ?: Yii::$app->theme->getAssetsUrl($this) . '/img/default-model-photo.jpg' ?>'"
           data-fancybox="gallery"></a>
      </div>
      <div class="b-cabinet__form-footer">
        <button class="b-button b-button_first b-cabinet__form-submit" type="submit">
          <span class="b-button__texts">
            <span class="b-button__text-first">Save changes</span>
          </span>
        </button>
      </div>
    <?php ActiveForm::end(); ?>
  </div>
</section>