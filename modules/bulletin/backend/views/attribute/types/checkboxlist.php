<?php
/**
 *
 */

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\types\forms\CheckboxListForm */
/* @var $form backend\widgets\langActiveForm\LangActiveForm */

?>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model->items, 'val')->textarea(['rows' => 6]) ?>
  </div>
</div>
