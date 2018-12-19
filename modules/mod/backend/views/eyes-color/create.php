<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\EyesColor */

$this->title = 'Создать eyes color';
$this->params['breadcrumbs'][] = ['label' => 'Eyes color', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eyes-color-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>