<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use modules\client\Module;

$this->title = Module::t('registration', 'Регистрация');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- b-content -->
<div class="b-content b-main__content">


  <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => [
      'class' => 'b-registration b-content__registration'
  ]]); ?>

    <header class="b-registration__header">
      <h2 class="b-registration__title">
        <?= Module::t('registration', 'Регистрация') ?>
      </h2>
    </header>

    <main class="b-registration__main">
      <div class="b-registration__form">
        <label class="b-field b-field_icon b-registration__field">
          <?= $form->field($model, 'email')->label(false)->textInput([
            'autofocus' => true,
            'type' => 'email',
            'class' => 'b-field__input',
            'placeholder' => Module::t('registration', 'Ваш email')
          ]) ?>
          <i class="b-field__icon b-field__icon_first-color fas fa-envelope"></i>
        </label>

        <label class="b-field b-field_icon b-registration__field">
          <?= $form->field($model, 'phone')->label(false)->textInput([
            'autofocus' => true,
            'type' => 'tel',
            'class' => 'b-field__input',
            'placeholder' => Module::t('registration', 'Ваш номер телефона')
          ]) ?>
          <i class="b-field__icon b-field__icon_first-color fas fa-phone"></i>
        </label>

        <label class="b-field b-field_icon b-registration__field">
          <?= $form->field($model, 'name')->label(false)->textInput([
            'autofocus' => true,
            'class' => 'b-field__input',
            'placeholder' => Module::t('registration', 'Ваше имя')
          ]) ?>
          <i class="b-field__icon b-field__icon_first-color fas fa-user"></i>
        </label>

        <label class="b-field b-field_icon b-registration__field">
          <?= $form->field($model, 'password')->label(false)->passwordInput([
            'autofocus' => true,
            'class' => 'b-field__input',
            'placeholder' => Module::t('registration', 'Пароль')
          ]) ?>
          <i class="b-field__icon b-field__icon_first-color fas fa-key"></i>
        </label>

        <label class="b-field b-field_icon b-registration__field">
          <?= $form->field($model, 'passwordRepeat')->label(false)->passwordInput([
            'autofocus' => true,
            'class' => 'b-field__input',
            'placeholder' => Module::t('registration', 'Повторите пароль')
          ]) ?>
          <i class="b-field__icon b-field__icon_first-color fas fa-key"></i>
        </label>
      </div>
    </main>

    <footer class="b-registration__footer">
      <div class="b-registration__action">
        <a class="b-registration__action-link" href="<?= \yii\helpers\Url::to(['login']) ?>"><?= Module::t('registration', 'Войти') ?></a>
        <button type="submit" class="b-button-first b-registration__action-submit">
          <span class="b-button-first__value"><?= Module::t('registration', 'Зарегистрироваться') ?></span>
        </button>
      </div>
    </footer>

  <?php ActiveForm::end(); ?>

</div>
<!-- b-content end -->
