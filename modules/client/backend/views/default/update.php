<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\client\common\models\Client */

$this->title = 'Обновление клиента: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="client-update">

    <?= $this->render('_form', [
      'model' => $model,
    ]) ?>

</div>