<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Bulletin */
/* @var $attributeTypeManager modules\bulletin\common\types\AttributeTypeManager */

$this->title = 'Создать объявление';
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulletin-create">

  <?= $this->render('_form', [
    'model' => $model,
    'attributeTypeManager' => $attributeTypeManager,
  ]) ?>

</div>