<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\AttributeType */

$this->title = 'Редактировать Attribute Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Attribute Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="attribute-type-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>