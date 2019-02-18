<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\like\common\models\Like */

$this->title = 'Создать Лайк';
$this->params['breadcrumbs'][] = ['label' => 'Лайки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="like-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>