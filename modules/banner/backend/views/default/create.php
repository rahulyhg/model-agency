<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\banner\common\models\Banner */

$this->title = 'Баннеры';
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>
<div class="banner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
