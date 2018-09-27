<?php

use yii\helpers\Html;

/* @var $this \common\lib\View */
/* @var $model modules\page\common\models\Page */

$this->title = "Обновить страницу";
$this->params['breadcrumbs'][] = ['label' => Страницы, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
