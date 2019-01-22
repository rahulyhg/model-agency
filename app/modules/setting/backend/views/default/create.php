<?php

use yii\helpers\Html;


/* @var $model modules\setting\common\models\Setting */

$this->title = 'Новая настройка';
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
