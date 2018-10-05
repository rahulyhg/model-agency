<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\CategoryAttribute */

$this->title = 'Редактировать Category Attribute: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Category Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="category-attribute-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>