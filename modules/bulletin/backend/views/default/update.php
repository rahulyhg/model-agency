<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Bulletin */

$this->title = 'Редактировать Bulletin: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Bulletins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="bulletin-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>