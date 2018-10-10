<?php
/**
 *
 */

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\bulletin\common\types\forms\MoneyForm */

?>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'isRequired')->checkbox() ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'numberMin')->textInput(['type' => 'number', 'step' => 1]) ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'numberMax')->textInput(['type' => 'number', 'step' => 1]) ?>
  </div>
</div>
