<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Complaint */

$this->title = 'Редактировать жалобу: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Жалобы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="complaint-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>