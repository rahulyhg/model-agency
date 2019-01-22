<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\HairColor */

$this->title = 'Редактировать цвет волос: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Цвета волос', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="hair-color-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>