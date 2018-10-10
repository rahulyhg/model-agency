<?php
/**
 *
 */

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\bulletin\common\types\forms\IntegerForm */

?>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'isRequired')->checkbox() ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'integerMin'/*, ['enableClientValidation' => false]*/)->textInput(['type' => 'number', 'step' => 1]) ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'integerMax'/*, ['enableClientValidation' => false]*/)->textInput(['type' => 'number', 'step' => 1]) ?>
  </div>
</div>
