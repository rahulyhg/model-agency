<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\BulletinStatus */

$this->title = 'Создать статус';
$this->params['breadcrumbs'][] = ['label' => 'Статусы объявлений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulletin-status-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>