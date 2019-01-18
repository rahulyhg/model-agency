<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\Country */

$this->title = 'Редактировать Country: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Country', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="country-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>