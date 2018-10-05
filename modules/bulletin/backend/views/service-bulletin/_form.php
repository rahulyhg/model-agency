<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\ServiceBulletin */
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
        <?= $form->field($model, 'entity_id')->textInput() ?>
          </div>
          <div class="col-md-6">
        <?= $form->field($model, 'service_id')->textInput() ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
        <?= $form->field($model, 'expires_at')->textInput() ?>
          </div>
        </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>

