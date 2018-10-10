<?php

use modules\bulletin\common\models\AttributeType;
use yii\helpers\Html;
use modules\lang\widgets\langActiveForm\ActiveForm;
use backend\widgets\crudActions\CrudActions;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Attribute */
/* @var $form modules\lang\widgets\langActiveForm\ActiveForm */
?>
<div class="attribute-form">
  <?php $form = ActiveForm::begin([
    'defaultLangInd' => $model->getDefaultLangInd(),
    'options' => [
      'id' => 'attribute-form',
    ]
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
      <div class="col-xl-8 offset-xl-2">
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'type_id')->widget(kartik\widgets\Select2::class, [
              'data' => AttributeType::getMap(),
              'options' => ['placeholder' => ''],
              'pluginOptions' => ['allowClear' => true],
              'pluginEvents' => [
                'change' => 'function() {
                window.location = "' . Url::current(['typeId' => '']) . '" + this.value;
                }',
              ]
            ]) ?>
          </div>
          <div class="col-md-6">
            <?= $form->field($model->variationModels, 'name')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'type_settings')->textarea(['rows' => 6]) ?>
          </div>
          <div class="col-md-6">
            <?= $form->field($model->variationModels, 'tr_type_settings')->textarea(['rows' => 6]) ?>
          </div>
        </div>
        <?php if($typeModel && $typeModel->viewName) : ?>
          <?= $this->render('types/'.$typeModel->viewName, ['form' => $form, 'model' => $typeModel]) ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>