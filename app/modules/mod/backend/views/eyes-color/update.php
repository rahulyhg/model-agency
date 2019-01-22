<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\EyesColor */

$this->title = 'Редактировать цвет глаз: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Цвета глаз', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="eyes-color-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>