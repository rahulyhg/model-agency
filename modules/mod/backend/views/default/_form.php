<?php

use kartik\widgets\FileInput;
use modules\mod\common\models\EyesColor;
use modules\mod\common\models\HairColor;
use yii\helpers\Html;
use modules\lang\widgets\langActiveForm\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\Mod */
/* @var $form backend\widgets\langActiveForm\LangActiveForm */

?>

<div class="mod-form">

  <?php $form = ActiveForm::begin([
    'defaultLangInd' => $model->getDefaultLangInd(),
  ]); ?>

    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <?= CrudActions::widget(["model" => $model, "template" => "{index}"]) ?>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                  <?= Html::dropDownList(null, $model->getDefaultLangInd(), $model->getLangMap(), [
                    'class' => 'form-control',
                    'id' => 'lang-dropdown',
                  ]) ?>
                </li>
                <li class="m-portlet__nav-item">
                  <?= CrudActions::widget(['model' => $model,]); ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-xl-8">
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
                <div class="row">
                    <div class="col-md-6">
                      <?= $form->field($model->variationModels, 'first_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                      <?= $form->field($model->variationModels, 'middle_name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <?= $form->field($model->variationModels, 'last_name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div class="col-cl-4">
              <?= $form->field($model, 'images')->widget(FileInput::class, [
                'options' => [
                  'accept' => 'image/*',
                  'multiple' => true,
                ]
              ]) ?>
            </div>
        </div>
      <?php ActiveForm::end(); ?>

    </div>
</div>