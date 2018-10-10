<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Attribute */

$this->title = 'Редактировать атрибут: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="attribute-update">

  <?= $this->render('_form', [
    'model' => $model,
    'typeModel' => $typeModel,
  ]) ?>

</div>