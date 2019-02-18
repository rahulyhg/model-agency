<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\SpokenLang */

$this->title = 'Редактировать Язык: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Языки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="spoken-lang-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>