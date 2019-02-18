<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\SpokenLang */

$this->title = 'Создать Язык';
$this->params['breadcrumbs'][] = ['label' => 'Языки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spoken-lang-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>