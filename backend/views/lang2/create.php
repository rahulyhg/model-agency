<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Lang */

$this->title = 'Создать Lang';
$this->params['breadcrumbs'][] = ['label' => 'Langs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
