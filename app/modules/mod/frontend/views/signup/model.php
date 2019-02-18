<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \modules\mod\frontend\forms\ModelSignUpForm */

use yii\helpers\Html;
use modules\mod\lib\ActiveForm;
use yii\helpers\Url;
use modules\mod\common\models\Mod;

$this->title = 'Регистрация модели';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(<<<JS
$(document).ready(function () {
  $('#bust_selector').select2({
      "minimumResultsForSearch": -1,
      "searchInputPlaceholder": 'Введите...',
      'language': {
          'noResults': function () {
              return "Не найдено";
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
JS
);
?>
  <section class="b-section b-main__item">
    <header class="b-section__header">
      <h1 class="b-title b-section__header-title"><span
            class="b-title__texts b-title__texts_line-first b-title__texts_line-wide"><span
              class="b-title__text-second">Регистрация</span><span class="b-title__text-first">модели</span></span>
      </h1>
    </header>
    <div class="b-registration b-section__main">
      <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'b-registration__form']
      ]); ?>
        <div class="b-registration__form-inner">
          <?= $form->field($model, 'phone', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-mobile-alt')->textInput([
            'autofocus' => true,
            'placeholder' => 'Номер телефона',
          ]) ?>
          <?= $form->field($model, 'email', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-envelope')->textInput([
            'placeholder' => 'Email',
          ]) ?>
          <?= $form->field($model, 'fullName', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-user-ninja')->textInput([
            'placeholder' => 'Полное имя',
          ]) ?>
          <?= $form->field($model, 'age', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-birthday-cake')->textInput([
            'placeholder' => 'Возраст',
          ]) ?>
          <?= $form->field($model, 'height', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-arrows-alt-v')->textInput([
            'placeholder' => 'Рост',
          ]) ?>
          <?= $form->field($model, 'weight', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-weight')->textInput([
            'type' => 'number',
            'placeholder' => 'Вес',
          ]) ?>
          <?= $form->field($model, 'waist', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-arrows-alt-h')->textInput([
            'placeholder' => 'Обхват талии',
          ]) ?>
          <?= $form->field($model, 'hips', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-arrows-alt-h')->textInput([
            'placeholder' => 'Обхват бедер',
          ]) ?>
          <?= $form->field($model, 'shoes', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-shoe-prints')->textInput([
            'placeholder' => 'Размер ноги',
          ]) ?>
          <div class="b-field-select b-field-select_icon b-registration__form-field">
              <div class="b-field__wrap">
                <?= $form->field($model, 'bust', ['template' => '{input}', 'options' => ['tag' => false]])
                  ->label(false)
                  ->dropDownList(Mod::getBustSizeMap(), [
                    'id' => 'bust_selector',
                    'class' => 'b-field-select__select2',
                    'placeholder' => 'Размер груди',
                  ]); ?>
                <i class="b-field-select__icon b-field-select__icon_focus-first fas fa-globe-europe"></i>
              </div>
            </label>
          </div>
          <?= $form->field($model, 'password', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-key')->passwordInput([
            'placeholder' => 'Пароль',
          ]) ?>
          <?= $form->field($model, 'passwordRepeat', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-key')->passwordInput([
            'placeholder' => 'Повторите пароль',
          ]) ?>
          <div class="b-registration__form-footer">
            <span class="b-link b-login__form-redirect">
              Уже зарегистрированы?
              <a class="b-link b-login__form-redirect-link" href="<?= Url::to(['/mod/auth/model']) ?>">
                <span class="b-link__texts b-link__texts_first b-link__texts_underline-first">
                  <span class="b-link__text">Войти</span>
                </span>
              </a>
            </span>
            <?= Html::submitButton('<span class="b-button__texts">
                    <span class="b-button__text-first">Зарегистрироваться</span>
                  </span>', [
              'type' => 'submit',
              'class' => 'b-button b-button_first b-registration__form-submit'
            ]) ?>
          </div>
        </div>
      <?php ActiveForm::end(); ?>
    </div>
  </section>