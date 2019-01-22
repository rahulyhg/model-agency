<?php

use yii\helpers\Html;


/* @var $this \common\lib\View */
/* @var $model modules\page\common\models\Page */

$this->title = "Создать страницу";
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
