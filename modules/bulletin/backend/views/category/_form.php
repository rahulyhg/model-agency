<?php

use backend\widgets\dynamicForm\DynamicFormWidget;
use yii\helpers\Html;
use modules\lang\widgets\langActiveForm\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Category */
/* @var $form backend\widgets\langActiveForm\LangActiveForm */

?>

<div class="category-form">

  <?php $form = ActiveForm::begin([
    'options' => ['id' => 'category-form'],
    'defaultLangInd' => $model->getDefaultLangInd(),
  ]); ?>

  <div class="m-portlet__head">
    <div class="m-portlet__head-caption">
      <?= CrudActions::widget(["model" => $model, "template" => "{index}"]) ?>
    </div>
    <div class="m-portlet__head-tools">
      <ul class="m-portlet__nav">
        <li class="m-portlet__nav-item">
          <?= Html::dropDownList(null, $model->getDefaultLangInd(), $model->getLangMap(), [
            'class' => 'form-control',
            'id' => 'lang-dropdown',
          ]) ?>
        </li>
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
            <?= $form->field($model, 'parent_id')->textInput() ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model->variationModels, 'name')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div id="panel-documents" class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-check-square-o"></i> Атрибуты</h3>
              </div>
              <?php
              $categoryAttributes = $model->categoryAttributes;
              if (empty($categoryAttributes)) {
                $categoryAttributes = [new \modules\bulletin\common\models\CategoryAttribute()];
              }
              DynamicFormWidget::begin([
                'widgetContainer' => 'attributes_dynamicform',
                'widgetBody' => '.attributes_container',
                'widgetItem' => $categoryAttributes[0]::WIDGET_ITEM,
                'sortableHandle' => 'attributes_sortable-handle',
                'min' => 0,
                'insertButton' => '.attributes_add',
                'deleteButton' => '.attributes_delete',
                'model' => $categoryAttributes[0],
                'formId' => 'category-form',
                'formFields' => [
                  'attribute_id',
                ],
              ]); ?>

              <table class="table table-condensed table-striped">
                <thead>
                <tr>
                  <th></th>
                  <th style="width: 100%;"><?= $categoryAttributes[0]->getAttributeLabel('attribute_id') ?></th>
                  <th></th>
                </tr>
                </thead>
                <tbody class="attributes_container">
                <?php foreach ($categoryAttributes as $index => $categoryAttribute): ?>
                  <tr class="<?= preg_replace('/^\./', '', $categoryAttribute::WIDGET_ITEM) ?>">
                    <td class="attributes_sortable-handle">
                      <span class="m-btn m-btn--icon m-btn--icon-only" style="cursor: move;"><i class="fa fa-arrows-alt"></i></span>
                    </td>
                    <td>
                      <?= $form->field($categoryAttribute, "[$index]attribute_id")->label(false)
                        ->widget(kartik\widgets\Select2::class, [
                          'data' => \modules\bulletin\common\models\Attribute::getMap(),
                          'options' => ['placeholder' => ''],
                          'pluginOptions' => ['allowClear' => true]
                        ]); ?>
                    </td>
                    <td class="text-center vcenter">
                      <button type="button" class="attributes_delete btn btn-danger m-btn m-btn--icon m-btn--icon-only">
                        <i
                          class="la la-minus"></i></button>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <td colspan="3" class="text-right">
                    <button type="button" class="attributes_add btn btn-primary m-btn m-btn--icon"><span><i
                          class="la la-plus"></i><span>Добавить</span></span>
                    </button>
                  </td>
                </tr>
                </tfoot>
              </table>
              <?php DynamicFormWidget::end(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>