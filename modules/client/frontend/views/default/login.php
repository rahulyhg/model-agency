<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \modules\client\frontend\forms\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="b-content b-main__content">

  <section class="b-authorization b-content__authorization">

    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => [
        'class' => ''
    ]]); ?>

    <header class="b-authorization__header">
      <h2 class="b-authorization__title">
        Авторизоваться
      </h2>
    </header>

    <main class="b-authorization__main">
      <div class="b-authorization__form" action="authorization">
        <label class="b-field b-field_icon b-authorization__field">
          <?= $form->field($model, 'phone')->label(false)->textInput([
            'autofocus' => true,
            'type' => 'tel',
            'class' => 'b-field__input',
            'placeholder' => 'Ваш номер телефона'
          ]) ?>
          <i class="b-field__icon b-field__icon_second-color fas fa-user-alt"></i>
        </label>

        <label class="b-field b-field_icon b-authorization__field">
          <?= $form->field($model, 'password')->label(false)->passwordInput([
            'autofocus' => true,
            'class' => 'b-field__input',
            'placeholder' => 'Пароль'
          ]) ?>
          <i class="b-field__icon b-field__icon_second-color fas fa-key"></i>
        </label>
      </div>
    </main>

    <footer class="b-authorization__footer">
      <div class="b-authorization__action">
        <a class="b-authorization__action-link" href="<?= \yii\helpers\Url::to(['signup']) ?>">Зарегистрироваться</a>
        <button type="submit" class="b-button-second b-authorization__action-submit">
          <span class="b-button-second__value">Войти</span>
        </button>
      </div>
    </footer>

  </section>

  <?php ActiveForm::end(); ?>

</main>
