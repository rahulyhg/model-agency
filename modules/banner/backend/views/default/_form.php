<?php

use backend\widgets\crudButtons\CrudButtons;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\banner\common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

  <?php $form = ActiveForm::begin([
    'options' => [
      'class' => 'm-form',
      'enctype' => 'multipart/form-data'
    ],
    'fieldConfig' => [
      'options' => [
        'class' => 'form-group m-form__group',
      ],
      'inputOptions' => [
        'class' => 'form-control m-input'
      ]
    ]
  ]); ?>

    <!--begin::Portlet-->
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
              <span class="m-portlet__head-icon m--hide">
                <i class="la la-gear"></i>
              </span>
                    <span class="m-portlet__head-icon">
                <i class="la la-money"></i>
              </span>
                    <h3 class="m-portlet__head-text">
                      <?= $this->title ?>
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                      <?= CrudButtons::widget([
                        'model' => $model
                      ]) ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row">

                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                          <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                          <?= $form->field($model, 'position')->textInput(['maxlength' => true, 'disabled' => $model->isNewRecord ? null : 'disabled']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                  <?= $form->field($model, 'text')->textarea(['rows' => 5]) ?>
                </div>

            </div>
        </div>
    </div>
    <!--end::Portlet-->

    <div class="form-group">
      <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>