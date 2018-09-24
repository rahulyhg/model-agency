<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile m-portlet--sticky">

  <?php $form = ActiveForm::begin(); ?>

  <div class="m-portlet__head">
    <div class="m-portlet__head-caption">
      <?= \backend\widgets\crudActions\CrudActions::widget(["model" => $model, "template" => "{index}"]) ?>
    </div>
    <div class="m-portlet__head-tools">
      <ul class="m-portlet__nav">
        <li class="m-portlet__nav-item">
          <?= \backend\widgets\crudActions\CrudActions::widget(["model" => $model, "template" => "{delete}{save}"]) ?>
        </li>
      </ul>
    </div>
  </div>
  <div class="m-portlet__body">
    <div class="row">
      <div class="col-xl-8 offset-xl-2">
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'id')->textInput() ?>
          </div>
          <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-md-6">
            <?= $form->field($model, 'ietf_tag')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'is_default')->textInput() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>

</div>
