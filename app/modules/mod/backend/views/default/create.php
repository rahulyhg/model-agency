<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\Mod */

$this->title = 'Создать модель';
$this->params['breadcrumbs'][] = ['label' => 'Модели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>