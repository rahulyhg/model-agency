<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\mod\common\models\Country */

$this->title = 'Создать Country';
$this->params['breadcrumbs'][] = ['label' => 'Country', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>