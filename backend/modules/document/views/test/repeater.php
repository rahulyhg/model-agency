<?php
/**
 * @var $models DocumentForm[]
 */
use backend\modules\document\forms\DocumentForm;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>
<div class="document-form">
  <!--  --><?php //Pjax::begin(['enablePushState' => false]) ?>
  <?php $form = ActiveForm::begin(/*['options' => ['data-pjax' => true]]/**/); ?>
  <?php foreach($models as $i => $dynamicModel) : ?>
  <?= $form->field($dynamicModel, "[$i]file")->widget(FileInput::class, [
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
    <?php
    $js = <<<JS
jQuery('[data-kv-cust-btn]').show().on('click', function() {
        var btn = $(this), key = btn.data('key');
        window.open(key, '_blank');
    });
JS;
    $this->registerJs($js);
    ?>
  <?php endforeach; ?>
  <div class="form-group">
    <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
  </div>
  <?php ActiveForm::end(); ?>
  <!--  --><?php //Pjax::end() ?>
</div>