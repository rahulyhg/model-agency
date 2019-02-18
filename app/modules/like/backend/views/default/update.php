<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\like\common\models\Like */

$this->title = 'Редактировать Лайк: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Лайки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="like-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>