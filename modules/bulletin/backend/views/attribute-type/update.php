<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\AttributeType */

$this->title = 'Редактировать тип: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы атрибутов', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="attribute-type-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>