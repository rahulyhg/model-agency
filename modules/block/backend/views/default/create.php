<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\block\common\models\Block */

$this->title = 'Create Block';
$this->params['breadcrumbs'][] = ['label' => 'Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->showTitle               = false;

?>
<div class="block-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
