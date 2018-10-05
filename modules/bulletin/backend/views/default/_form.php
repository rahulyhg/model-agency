<?php

use modules\bulletin\common\models\Category;
use modules\client\common\models\Client;
use modules\location\common\models\Location;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Bulletin */
/* @var $form yii\widgets\ActiveForm */
/* @var $attributeTypeManager modules\bulletin\common\types\AttributeTypeManager */
?>



<?php $form = ActiveForm::begin(); ?>

<div class="m-portlet__head">
  <div class="m-portlet__head-caption">
    <?= CrudActions::widget(["model" => $model, "template" => "{index}"]) ?>
  </div>
  <div class="m-portlet__head-tools">
    <ul class="m-portlet__nav">
      <li class="m-portlet__nav-item">
        <?= CrudActions::widget(['model' => $model,]); ?>
      </li>
    </ul>
  </div>
</div>
<div class="m-portlet__body">

  <div class="row">
    <div class="col-xl-8 offset-xl-2">
        <div class="row">
          <div class="col-md-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-md-6">
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
        <?= $form->field($model, 'location_id')->widget(kartik\widgets\Select2::class, [
                      'data' => Location::getMap(),
                      'options' => ['placeholder' => ''],
                      'pluginOptions' => ['allowClear' => true],
                    ]) ?>
          </div>
          <div class="col-md-6">
        <?= $form->field($model, 'client_id')->widget(kartik\widgets\Select2::class, [
                      'data' => Client::getMap(),
                      'options' => ['placeholder' => ''],
                      'pluginOptions' => ['allowClear' => true],
                    ]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
        <?= $form->field($model, 'category_id')->widget(kartik\widgets\Select2::class, [
                      'data' => Category::getMap(),
                      'options' => ['placeholder' => ''],
                      'pluginOptions' => ['allowClear' => true],
                    ]) ?>
          </div>
          <div class="col-md-6">
        <?= $form->field($model, 'status_id')->widget(kartik\widgets\Select2::class, [
          'data' => \modules\bulletin\common\models\BulletinStatus::getMap(),
          'options' => ['placeholder' => ''],
          'pluginOptions' => ['allowClear' => true],
        ]) ?>
          </div>
        </div>
      <div class="row">
        <?php foreach($attributeTypeManager->generateFields($form) as $field): ?>
          <div class="col-md-6">
            <?= $field ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>

