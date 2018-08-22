<?php

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">


	<?php $form = ActiveForm::begin( [
		'options' => [
			'class' => 'm-form',
			'enctype' => 'multipart/form-data'
		],
		'fieldConfig' => [
			'options' => [
				'class' => 'form-group m-form__group',
			],
			'inputOptions' => [
				'class' => 'form-control m-input'
			]
		]
	] ); ?>
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
            Users
          </h3>
        </div>
      </div>
      <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
          <li class="m-portlet__nav-item">
			      <?= Html::submitButton( '<span><i class="la la-save"></i><span>Save</span></span>', [ 'class' => 'btn btn-success m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air' ] ) ?>
          </li>
        </ul>
      </div>
    </div>
    <div class="m-portlet__body">
      <div class="row">
        <div class="col-md-3">
	        <?php if (!$model->isNewRecord): ?>
		        <?= Html::activeHiddenInput($model, "deletePhotoFile"); ?>
	        <?php endif; ?>
	        <?= $form->field($model, 'photoFile')->widget(FileInput::class, [
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
				        $model->photoUrl ? Html::img($model->photoUrl, ['class' => 'file-preview-image', 'style' => 'max-width: 100%']) : null,
			        ],
			        'layoutTemplates' => ['footer' => '']
		        ],
		        'pluginEvents' => [
			        'filecleared' => 'function(e) {
                  $("#' . Html::getInputId($model, "deletePhotoFile") . '").val(1);
              }',
		        ]
	        ]);
	        ?>
        </div>
        <div class="col-md-9">
		    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
		    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
		    <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>

</div>
