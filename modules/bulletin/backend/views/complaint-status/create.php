<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\ComplaintStatus */

$this->title = 'Создать статус';
$this->params['breadcrumbs'][] = ['label' => 'Статусы жалоб', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-status-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>