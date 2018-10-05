<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\CategoryAttributeGroup */

$this->title = 'Создать группу атрибутов';
$this->params['breadcrumbs'][] = ['label' => 'Группы атрибутов в категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-attribute-group-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>