<?php

use backend\widgets\crudButtons\CrudButtons;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\page\common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-form">
  <div class="row">
    <div class="col-lg-12">
			<?php $form = ActiveForm::begin( [
				'options'     => [
					'class'   => 'm-form',
					'enctype' => 'multipart/form-data'
				],
				'fieldConfig' => [
					'options'      => [
						'class' => 'form-group m-form__group',
					],
					'inputOptions' => [
						'class' => 'form-control m-input'
					]
				]
			] ); ?>
      <!--begin::Portlet-->
      <div class="m-portlet">
        <div class="m-portlet__head">
          <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
              <span class="m-portlet__head-icon m--hide">
                <i class="la la-gear"></i>
              </span>
              <span class="m-portlet__head-icon">
                <i class="la la-money"></i>
              </span>
              <h3 class="m-portlet__head-text">
                Page
              </h3>
            </div>
          </div>
          <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
              <li class="m-portlet__nav-item">
								<?= CrudButtons::widget( [
									'model' => $model
								] ) ?>
              </li>
            </ul>
          </div>
        </div>
        <div class="m-portlet__body">
          <div class="row">
            <div class="col-md-8 m-form__section">
							<?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => true ] ) ?>
							<?= $form->field( $model, 'slug' )->textInput( [ 'maxlength' => true, 'disabled' => 'disabled' ] ) ?>
							<?= $form->field( $model, 'content' )->widget( \vova07\imperavi\Widget::class, [
								'settings' => [
									'lang'             => 'he',
									'direction' 			 => 'rtl',
									'minHeight'        => 300,
									'replaceDivs'      => true,
									'paragraphize'     => false,
									'imageUpload'      => Url::to( [ 'image-upload' ] ),
									'imageDelete'      => Url::to( [ 'file-delete' ] ),
									'imageManagerJson' => Url::to( [ 'images-get' ] ),
								],
								'plugins'  => [
									'imagemanager' => \vova07\imperavi\bundles\ImageManagerAsset::class,
								],
							] );
							?>
            </div>
            <div class="col-md-4">
							<?php if (!$model->isNewRecord): ?>
								<?= Html::activeHiddenInput($model, "deleteThumbnailFile"); ?>
							<?php endif; ?>
							<?= $form->field($model, 'thumbnailFile')->widget(FileInput::class, [
								'options' => [
									'accept' => 'image/*',
									'multiple' => false,
								],
								'pluginOptions' => [
									'previewFileType' => 'image',
									'showCaption' => false,
									'showUpload' => false,
									'showClose' => false,
									'removeIcon' => '<i class="glyphicon glyphicon-remove"></i>',
									'removeLabel' => '',
									'initialPreview' => [
										$model->thumbnailUrl ? Html::img($model->thumbnailUrl, ['class' => 'file-preview-image', 'style' => 'max-width: 100%']) : null,
									],
									'layoutTemplates' => ['footer' => '']
								],
								'pluginEvents' => [
									'filecleared' => 'function(e) {
                  $("#' . Html::getInputId($model, "deleteThumbnailFile") . '").val(1);
              }',
								]
							]);
							?>
            </div>
          </div>
        </div>
      </div>
      <!--end::Portlet-->
			<?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
