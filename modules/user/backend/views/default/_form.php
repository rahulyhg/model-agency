<?php

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\user\common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

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

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>