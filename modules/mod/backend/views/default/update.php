<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\Mod */

$this->title = 'Редактировать mod: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mod', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="mod-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>