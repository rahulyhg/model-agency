<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\CategoryAttribute */

$this->title = 'Создать Category Attribute';
$this->params['breadcrumbs'][] = ['label' => 'Category Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-attribute-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>