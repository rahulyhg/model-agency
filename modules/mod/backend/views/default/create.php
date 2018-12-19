<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\Mod */

$this->title = 'Создать mod';
$this->params['breadcrumbs'][] = ['label' => 'Mod', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>