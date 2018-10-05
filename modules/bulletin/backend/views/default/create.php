<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Bulletin */

$this->title = 'Создать Bulletin';
$this->params['breadcrumbs'][] = ['label' => 'Bulletins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulletin-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>