<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Lang */

$this->title = 'Редактировать Lang: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Langs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="lang-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
