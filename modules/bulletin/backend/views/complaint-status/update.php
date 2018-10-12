<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\ComplaintStatus */

$this->title = 'Редактировать статус: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Статусы жалоб', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="complaint-status-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>