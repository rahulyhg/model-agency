<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

/* @var $model \modules\mod\frontend\forms\ModelLoginForm */

use \modules\mod\lib\ActiveForm;
use yii\helpers\Url;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
  <section class="b-section b-main__item b-main__item_login">
    <header class="b-section__header">
      <h1 class="b-title b-section__header-title">
        <span class="b-title__texts b-title__texts_line-first b-title__texts_line-wide">
          <span class="b-title__text-first">Контакты</span>
        </span>
      </h1>
    </header>
    <div class="b-login b-section__main">
      <p><b>Наш email:</b> contact@celeb.cloud</p>
      <br>
      <br>
      <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'b-login__form']]); ?>
      <?= $form->field($model, 'name', ['options' => ['class' => 'b-login__form-field']])->title(false)->icon('fas fa-user')->textInput([
        'autofocus' => true,
        'placeholder' => 'Имя *',
      ]) ?>
      <?= $form->field($model, 'email', ['options' => ['class' => 'b-login__form-field']])->title(false)->icon('fas fa-envelope')->textInput([
        'autofocus' => true,
        'placeholder' => 'Email *',
      ]) ?>
      <?= $form->field($model, 'subject', ['options' => ['class' => 'b-login__form-field']])->title(false)->icon('fas fa-font')->textInput([
        'autofocus' => true,
        'placeholder' => 'Тема письма *',
      ]) ?>
      <?= $form->field($model, 'body', ['options' => ['class' => 'b-login__form-field']])->title(false)->icon('fas fa-align-justify')->textarea([
        'style' => 'resize: none;',
        'autofocus' => true,
        'placeholder' => 'Ваше сообщение *',
        'rows' => 6
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
