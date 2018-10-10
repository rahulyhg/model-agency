<?php
/**
 *
 */

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\types\forms\SelectForm */
/* @var $form backend\widgets\langActiveForm\LangActiveForm */

?>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'isRequired')->checkbox() ?>
  </div>
  <div class="col-md-6">
    <?= $form->field($model->items, 'val')->textarea(['rows' => 6]) ?>
  </div>
</div>
