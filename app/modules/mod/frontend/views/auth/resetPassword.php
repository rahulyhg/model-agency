<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use modules\mod\lib\ActiveForm;

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="b-section b-main__item b-main__item_login">
  <header class="b-section__header">
    <h1 class="b-title b-section__header-title"><span
          class="b-title__texts b-title__texts_line-first b-title__texts_line-wide"><span
            class="b-title__text-second">
          <?= Html::encode($this->title) ?>
        </span></h1>
  </header>
  <div class="b-login b-section__main">
    <p>Пожалуйста, введите новый пароль:</p>
    <br>
    <br>
    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-token-form', 'options' => ['class' => 'b-login__form']]); ?>
    <?= $form->field($model, 'password', ['options' => ['class' => 'b-login__form-field']])
      ->title(false)
      ->icon('fas fa-key')
      ->passwordInput([
        'autofocus' => true,
        'placeholder' => 'Новый пароль',
      ]) ?>
    <div class="b-login__form-footer">
      <button class="b-button b-button_first b-login__form-submit" type="submit">
            <span class="b-button__texts">
              <span class="b-button__text-first">Отправить</span>
            </span>
      </button>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</section>