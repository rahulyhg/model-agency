<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Service */

$this->title = 'Редактировать услугу: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="service-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>