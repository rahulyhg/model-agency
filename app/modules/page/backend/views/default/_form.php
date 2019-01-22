<?php

use modules\lang\widgets\langActiveForm\ActiveForm;
use yii\helpers\Html;
use backend\widgets\crudActions\CrudActions;

/* @var $this \common\lib\View */
/* @var $model modules\page\common\models\Page */
/* @var $form backend\widgets\langActiveForm\LangActiveForm */
?>
<?php $form = ActiveForm::begin([
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
        <div class="col-md-9">
            <?= $form->field($model->variationModels, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model->variationModels, 'content')->widget(\vova07\imperavi\Widget::class, [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 300,
                    'replaceDivs' => true,
                    'paragraphize' => false,
                    'imageUpload' => \yii\helpers\Url::to(['/imperavi/image-upload']),
                    'imageDelete' => \yii\helpers\Url::to(['/imperavi/file-delete']),
                    'imageManagerJson' => \yii\helpers\Url::to(['/imperavi/images-get']),
                ],
                'plugins' => [
                    'imagemanager' => \vova07\imperavi\bundles\ImageManagerAsset::class,
                ],
            ]) ?>
            <?= $form->field($model->variationModels, 'seo_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model->variationModels, 'seo_description')->textarea(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'thumbFile')->widget(\kartik\widgets\FileInput::class, [
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
                        $model->thumbUrl ? Html::img($model->thumbUrl, ['class' => 'file-preview-image', 'style' => 'max-width: 100%']) : null,
                    ],
                    'layoutTemplates' => ['footer' => '']
                ],
                'pluginEvents' => [
                    'filecleared' => 'function(e) {
                        $("#' . Html::getInputId($model, "deleteThumbFile") . '").val(1);
                    }',
                ]
            ]);
            ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>