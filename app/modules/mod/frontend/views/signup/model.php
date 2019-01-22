<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \modules\mod\frontend\forms\ModelSignUpForm */

use yii\helpers\Html;
use modules\mod\lib\ActiveForm;
use yii\helpers\Url;

$this->title = 'Register as a model';
$this->params['breadcrumbs'][] = $this->title;
?>
  <section class="b-section b-main__item">
    <header class="b-section__header">
      <h1 class="b-title b-section__header-title"><span
            class="b-title__texts b-title__texts_line-first b-title__texts_line-wide"><span
              class="b-title__text-second">Register as a</span><span class="b-title__text-first">model</span></span>
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
            'placeholder' => 'Phone number',
          ]) ?>
          <?= $form->field($model, 'email', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-envelope')->textInput([
            'placeholder' => 'Email',
          ]) ?>
          <?= $form->field($model, 'firstName', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-user-ninja')->textInput([
            'placeholder' => 'First name',
          ]) ?>
          <?= $form->field($model, 'age', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-birthday-cake')->textInput([
            'placeholder' => 'Age',
          ]) ?>
          <?= $form->field($model, 'lastName', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-user-ninja')->textInput([
            'placeholder' => 'Last name',
          ]) ?>
          <?= $form->field($model, 'password', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-key')->passwordInput([
            'placeholder' => 'Password',
          ]) ?>
          <?= $form->field($model, 'middleName', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-user-ninja')->textInput([
            'placeholder' => 'Middle name',
          ]) ?>
          <?= $form->field($model, 'passwordRepeat', ['options' => ['class' => 'b-registration__form-field']])->title(false)->icon('fas fa-key')->passwordInput([
            'placeholder' => 'Confirm password',
          ]) ?>
          <div class="b-registration__form-footer">
            <span class="b-link b-login__form-redirect">
              Already registered?
              <a class="b-link b-login__form-redirect-link" href="<?= Url::to(['/mod/auth/model']) ?>">
                <span class="b-link__texts b-link__texts_first b-link__texts_underline-first">
                  <span class="b-link__text">Login now!</span>
                </span>
              </a>
            </span>
            <?= Html::submitButton('<span class="b-button__texts">
                    <span class="b-button__text-first">Register me</span>
                  </span>', [
              'type' => 'submit',
              'class' => 'b-button b-button_first b-registration__form-submit'
            ]) ?>
          </div>
        </div>
      <?php ActiveForm::end(); ?>
    </div>
  </section>