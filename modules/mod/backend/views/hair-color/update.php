<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\HairColor */

$this->title = 'Редактировать hair color: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hair color', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="hair-color-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>