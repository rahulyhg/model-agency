<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model modules\client\common\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>



<?php $form = ActiveForm::begin(); ?>

<div class="m-portlet__head">
  <div class="m-portlet__head-caption">
    <?= CrudActions::widget(["model" => $model, "template" => "{index}"]) ?>
  </div>
  <div class="m-portlet__head-tools">
    <ul class="m-portlet__nav">
      <li class="m-portlet__nav-item">
        <?= CrudActions::widget(['model' => $model,]); ?>
      </li>
    </ul>
  </div>
</div>
<div class="m-portlet__body">

  <div class="row">
    <div class="col-xl-8 offset-xl-2">
        <div class="row">
          <div class="col-md-6">
        <?= $form->field($model, 'avatar_id')->textInput() ?>
          </div>
          <div class="col-md-6">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-md-6">
        <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
        <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-md-6">
        <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
        <?= $form->field($model, 'location_id')->textInput() ?>
          </div>
          <div class="col-md-6">
        <?= $form->field($model, 'status')->textInput() ?>
          </div>
        </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>

