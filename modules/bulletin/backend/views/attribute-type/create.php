<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\AttributeType */

$this->title = 'Создать тип';
$this->params['breadcrumbs'][] = ['label' => 'Типы атрибутов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-type-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>