<?php
/**
 *
 */
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>
<div class="document-form">
  <!--  --><?php //Pjax::begin(['enablePushState' => false]) ?>
  <?php $form = ActiveForm::begin(/*['options' => ['data-pjax' => true]]/**/); ?>
  <?= $form->field($dynamicModel, "file")->widget(FileInput::class, [
    'options' => [
      'multiple' => false,
    ],
    'pluginOptions' => [
      'hideThumbnailContent' => true,
      'showCaption' => false,
      'showUpload' => false,
      'showClose' => false,
      'showRemove' => false,
      'initialPreview' => [
        $dynamicModel->getFileUrl()
      ],
      'initialPreviewConfig' => [
        ['key' => $dynamicModel->getFileUrl(), 'caption' => $dynamicModel->getFileCaption(), 'size' => $dynamicModel->getFileSize(),],
      ],
      'layoutTemplates' => [
        'actions' => '<div class="file-actions"><div class="file-footer-buttons">{other}</div></div>',
      ],
      'otherActionButtons' => '<button type="button" data-kv-cust-btn class="btn btn-xs btn-default" style="display: none" {dataKey}><i class="glyphicon glyphicon-download"></i> Открыть</button>',/**/
    ],
  ]) ?>
  <div class="form-group">
    <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
  </div>
  <?php ActiveForm::end(); ?>
  <!--  --><?php //Pjax::end() ?>
</div>