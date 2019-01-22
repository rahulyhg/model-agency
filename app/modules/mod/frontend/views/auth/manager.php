<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
  <section class="b-section b-main__item b-main__item_login">
    <header class="b-section__header">
      <h1 class="b-title b-section__header-title"><span
            class="b-title__texts b-title__texts_line-second b-title__texts_line-wide"><span
              class="b-title__text-second">Login for</span><span class="b-title__text-first">user</span></span></h1>
    </header>
    <div class="b-login b-section__main">
      <h1>In development!</h1>
      <form class="b-login__form" action="login-model">
        <label class="b-field b-login__form-field">
          <input class="b-field__input b-field__input_icon" type="text" name="login" required
                 placeholder="Phone number"><i class="b-field__icon b-field__icon_focus-second fas fa-mobile-alt"></i>
        </label>
        <label class="b-field b-login__form-field">
          <input class="b-field__input b-field__input_icon" type="password" name="password" required
                 placeholder="Password"><i class="b-field__icon b-field__icon_focus-second fas fa-key"></i>
        </label>
        <div class="b-login__form-footer"><span class="b-link b-login__form-redirect">Not registered?<a
                class="b-link b-login__form-redirect-link" href="<?= Url::to(['/mod/signup/manager']) ?>"><span
                  class="b-link__texts b-link__texts_second b-link__texts_underline-second"><span class="b-link__text">Join now!</span></span></a></span>
          <label class="b-checkbox b-login__form-remember">
            <input class="b-checkbox__input" type="checkbox" checked name="remember">
            <div class="b-checkbox__box">
              <div class="b-checkbox__checked b-checkbox__checked_second"></div>
            </div>
            <div class="b-checkbox__texts">
              <div class="b-checkbox__text">Remember me</div>
            </div>
          </label>
          <button class="b-button b-button_second b-login__form-submit" type="submit"><span
                class="b-button__texts"><span class="b-button__text-first">Sign in</span></span></button>
        </div>
      </form>
    </div>
  </section>
<?php
/*
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

  */