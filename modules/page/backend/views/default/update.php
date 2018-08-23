<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\page\common\models\Page */

$this->title                   = 'Update Page: ' . $model->title;
$this->showTitle               = false;
$this->params['breadcrumbs'][] = [ 'label' => 'Pages', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->title, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-update">

	<?= $this->render( '_form', [
		'model' => $model,
	] ) ?>

</div>
