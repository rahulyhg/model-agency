<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Complaint */

$this->title = 'Создать жалобу';
$this->params['breadcrumbs'][] = ['label' => 'Жалобы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>