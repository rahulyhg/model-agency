<?php

use kartik\widgets\FileInput;
use modules\mod\common\models\EyesColor;
use modules\mod\common\models\HairColor;
use modules\mod\common\services\ModService;
use yii\helpers\Html;
use backend\widgets\activeForm\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\Mod */
/* @var $form backend\widgets\langActiveForm\LangActiveForm */

?>

<div class="mod-form">

  <?php $form = ActiveForm::begin([
  ]); ?>

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
      <?= $form->errorSummary($model); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                  <div class="col-md-6">
                    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="col-md-3">
                    <?= $form->field($model, 'height')->textInput(['type' => 'number']) ?>
                  </div>
                  <div class="col-md-3">
                    <?= $form->field($model, 'weight')->textInput(['type' => 'number']) ?>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <?= $form->field($model, 'bust')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                      <?= $form->field($model, 'waist')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <?= $form->field($model, 'hips')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                      <?= $form->field($model, 'eyes_color_id')->widget(kartik\widgets\Select2::class, [
                        'data' => EyesColor::getMap(),
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => ['allowClear' => true],
                      ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <?= $form->field($model, 'hair_color_id')->widget(kartik\widgets\Select2::class, [
                        'data' => HairColor::getMap(),
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => ['allowClear' => true],
                      ]) ?>
                    </div>
                    <div class="col-md-6">
                      <?= $form->field($model, 'shoes')->textInput() ?>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <?php
                $fileInputData = ModService::getFileInputData($model);

                echo $form->field($model, 'images[]')->widget(FileInput::class, [
                  'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                  ],
                  'pluginOptions' => [
                    'previewFileType' => 'image',
                    'showCaption' => false,
                    'showUpload' => false,
                    'showClose' => false,
                    'removeLabel' => '',
                    'initialPreview' => $fileInputData['imagesUrls'],
                    'initialPreviewAsData' => true,
                    'overwriteInitial' => true,
                    'maxFileSize' => 2800,
                    'initialPreviewConfig' => $fileInputData['initialPreviewConfig']
                  ],
                  'pluginEvents' => [
                    'filesorted' => "function (event, params) {
                        var orderArr = params.stack;                        
                        var order = [];
                        orderArr.forEach(function(element){
                            order.push(element.key);
                        });
                        order = JSON.stringify(order);
                        
                        $('#modImageId').val(order);                        
                    }
                      "
                  ],
                ])
                ?>
                <?= $form->field($model, 'images_order_json')->hiddenInput(['id' => 'modImageId'])->label(false) ?>
              </div>
            </div>
        </div>
      <?php ActiveForm::end(); ?>

    </div>
</div>