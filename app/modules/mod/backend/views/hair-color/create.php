<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\HairColor */

$this->title = 'Создать цвет волос';
$this->params['breadcrumbs'][] = ['label' => 'Цвета волос', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hair-color-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>