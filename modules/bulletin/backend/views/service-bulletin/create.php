<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\ServiceBulletin */

$this->title = 'Создать Service Bulletin';
$this->params['breadcrumbs'][] = ['label' => 'Service Bulletins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-bulletin-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>