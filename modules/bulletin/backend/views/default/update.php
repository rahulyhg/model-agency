<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Bulletin */
/* @var $attributeTypeManager modules\bulletin\common\types\AttributeTypeManager */

$this->title = 'Редактировать объявление: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="bulletin-update">

  <?= $this->render('_form', [
    'model' => $model,
    'attributeTypeManager' => $attributeTypeManager,
    'galleryForm' => $galleryForm,
  ]) ?>

</div>