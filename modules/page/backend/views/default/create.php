<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\page\common\models\Page */

$this->title                   = 'Create Page';
$this->showTitle               = false;
$this->params['breadcrumbs'][] = [ 'label' => 'Pages', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

	<?= $this->render( '_form', [
		'model' => $model,
	] ) ?>

</div>
