<?php

use modules\bulletin\common\models\Bulletin;
use modules\bulletin\common\models\ComplaintStatus;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Complaint */
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
        <?= $form->field($model, 'entity_id')->widget(kartik\widgets\Select2::class, [
                      'data' => Bulletin::getMap(),
                      'options' => ['placeholder' => ''],
                      'pluginOptions' => ['allowClear' => true],
                    ]) ?>
          </div>
          <div class="col-md-6">
            <?= $form->field($model, 'status_id')->widget(kartik\widgets\Select2::class, [
              'data' => ComplaintStatus::getMap(),
              'options' => ['placeholder' => ''],
              'pluginOptions' => ['allowClear' => true],
            ]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-md-6">
            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
          </div>
        </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
