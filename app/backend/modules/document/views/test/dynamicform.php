<?php
/**
 * @var $models DocumentForm[]
 */
use backend\modules\document\forms\DocumentForm;
use backend\widgets\dynamicform\DynamicFormWidget;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;

$dynamicModel = $models[0];
?>
<div class="document-form">
    <?php Pjax::begin(['enablePushState' => false]) ?>
  <?php $form = ActiveForm::begin(['options' => ['id' => 'document-form' ,'data-pjax' => true]]); ?>
  <div id="panel-documents" class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-check-square-o"></i> Документы</h3>
    </div>
    <?php DynamicFormWidget::begin([
      'widgetContainer' => 'doc_dynamicform_wrapper',
      'widgetBody' => '.form-documents-body',
      'widgetItem' => '.form-documents-item',
      'min' => 1,
      'insertButton' => '.doc-add-item',
      'deleteButton' => '.doc-remove-item',
      'model' => $dynamicModel,
      'formId' => 'document-form',
      'formFields' => ['file'/*, 'description'*/],
    ]); ?>

    <table>
      <thead>
      <tr>
        <th><?= $dynamicModel->getAttributeLabel('file') ?></th>
<!--        <th>--><?//= $dynamicModel->getAttributeLabel('description') ?><!--</th>-->
        <th style="width: 90px; text-align: center"></th>
      </tr>
      </thead>
      <tbody class="form-documents-body">
      <?php foreach ($models as $i => $dynamicModel) : ?>
        <tr class="form-documents-item">
          <td>
            <?= $form->field($dynamicModel, "[$i]file")->label(false)->widget(FileInput::class, [
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
          </td>
<!--          <td>-->
<!--            --><?//= $form->field($dynamicModel, "[$i]description")->textarea(['rows' => 6]) ?>
<!--          </td>-->
          <td>
            <button type="button" class="doc-remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
      <tr>
        <td colspan="3">
          <button type="button" class="doc-add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
        </td>
      </tr>
      </tfoot>
    </table>

    <?php DynamicFormWidget::end(); ?>
  </div>
  <div class="form-group">
    <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
  </div>
  <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>
</div>