<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\BulletinStatus */

$this->title = 'Редактировать статус: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Статусы объявлений', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="bulletin-status-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>