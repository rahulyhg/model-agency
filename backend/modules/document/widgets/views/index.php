<?php

use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $models backend\modules\document\models\DocumentData */
/* @var $encryptedEntity string */
/* @var $pjaxContainerId string */
/* @var $formId string comment form id */
/* @var $documentWrapperId string */
?>
<div class="document-wrapper">
  <?php Pjax::begin([
    'enableReplaceState' => false,
    'enablePushState' => false,
  ]) ?>
  <?= $this->render('_form', [
    'models' => $models,
    'encryptedEntity' => $encryptedEntity,
  ]) ?>
  <?php Pjax::end() ?>
</div>
