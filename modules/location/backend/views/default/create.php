<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\location\common\models\Location */

$this->title = 'Создать населенный пункт';
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>