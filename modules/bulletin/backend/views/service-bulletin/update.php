<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\ServiceBulletin */

$this->title = 'Редактировать Service Bulletin: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Service Bulletins', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="service-bulletin-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>