<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use modules\mod\lib\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Запрос сброса пароля';
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
    <p>Пожалуйста, укажите Ваш email, который Вы использовали при регистрации на нашем сайте.
      Ссылка для сброса пароля будет отправлена на email.</p>
    <br>
    <br>
    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-token-form', 'options' => ['class' => 'b-login__form']]); ?>
    <?= $form->field($model, 'email', ['options' => ['class' => 'b-login__form-field']])
      ->title(false)
      ->icon('fas fa-envelope')
      ->textInput([
          'autofocus' => true,
          'placeholder' => 'Email',
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
