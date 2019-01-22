<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\location\common\models\Location */

$this->title = 'Редактировать населенный пункт: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="location-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>