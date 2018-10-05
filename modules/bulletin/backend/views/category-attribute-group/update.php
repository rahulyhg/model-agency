<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\CategoryAttributeGroup */

$this->title = 'Редактировать группу атрибутов: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Группы атрибутов в категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="category-attribute-group-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>