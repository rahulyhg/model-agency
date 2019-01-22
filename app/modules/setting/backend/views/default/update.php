<?php

use yii\helpers\Html;

/* @var $model modules\setting\common\models\Setting */

$this->title = 'Обновить настройку: ' . $model->section . '.' . $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="setting-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
