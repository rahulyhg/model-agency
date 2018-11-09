<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Bulletin */
/* @var $attributeTypeManager modules\bulletin\common\types\AttributeTypeManager */

$this->title = 'Добавить объявление';
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
  'model' => $model,
  'attributeTypeManager' => $attributeTypeManager,
  'galleryForm' => $galleryForm,
]) ?>
