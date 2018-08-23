<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\block\common\models\Block */

$this->title = 'Update Block: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->showTitle               = false;
?>
<div class="block-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
