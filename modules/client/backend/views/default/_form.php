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
        <div class="col-md-12">
          <?= $form->errorSummary($model) ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'avatarFile')->widget(\kartik\widgets\FileInput::class, [
            'options' => [
              'accept' => 'image/*',
              'multiple' => false,
            ],
            'pluginOptions' => [
              'previewFileType' => 'image',
              'showCaption' => false,
              'showUpload' => false,
              'showClose' => false,
              'removeIcon' => '<i class="glyphicon glyphicon-remove"></i>',
              'removeLabel' => '',
              'initialPreview' => [
                $model->avatarUrl ? Html::img($model->avatarUrl, ['class' => 'file-preview-image', 'style' => 'max-width: 100%']) : null,
              ],
              'layoutTemplates' => ['footer' => '']
            ],
            'pluginEvents' => [
              'filecleared' => 'function(e) {
                  $("#' . Html::getInputId($model, "deleteAvatarFile") . '").val(1);
              }',
            ]
          ]);
          ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'location_id')->widget(\kartik\widgets\Select2::class, [
              'data' => \modules\location\common\models\Location::getMap()
          ]) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>

