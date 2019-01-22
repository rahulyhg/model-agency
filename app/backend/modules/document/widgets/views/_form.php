<?php

use backend\widgets\dynamicform\DynamicFormWidget;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $models backend\modules\document\models\DocumentData */
/* @var $encryptedEntity string */
/* @var $formId string comment form id */

$dynamicModel = $models[0];
?>
<?php $form = ActiveForm::begin([
  'options' => ['id' => 'document-form', 'data-pjax' => true],
  'action' => Url::to(['/document/default/create', 'entity' => $encryptedEntity]),
  //'enableClientValidation' => false,
]); ?>
  <div id="panel-documents" class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-check-square-o"></i> Документы</h3>
    </div>
    <?php DynamicFormWidget::begin([
      'widgetContainer' => 'doc_dynamicform_wrapper',
      'widgetBody' => '.form-documents-body',
      'widgetItem' => '.form-documents-item',
      'min' => 0,
      'insertButton' => '.doc-add-item',
      'deleteButton' => '.doc-remove-item',
      'model' => $dynamicModel,
      'formId' => 'document-form',
      'formFields' => ['file', 'description'],
    ]); ?>

    <table class="table table-condensed">
      <thead>
      <tr>
        <th style="width: 90px; text-align: center"></th>
        <th><?= $dynamicModel->getAttributeLabel('file') ?></th>
        <th><?= $dynamicModel->getAttributeLabel('description') ?></th>
      </tr>
      </thead>
      <tbody class="form-documents-body">
      <?php foreach ($models as $i => $dynamicModel) : ?>
        <tr class="form-documents-item">
          <td>
            <button type="button" class="doc-remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
          </td>
          <td>
            <?php if (!$dynamicModel->isNewRecord) : ?>
              <?= Html::activeHiddenInput($dynamicModel, "[$i]id"); ?>
              <?= Html::activeHiddenInput($dynamicModel, "[$i]file_id"); ?>
            <?php endif; ?>
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
                'showCancel' => false,
                'showDownload' => true,
                'initialPreview' => [
                  $dynamicModel->getFileUrl()
                ],
                'initialPreviewConfig' => [
                  ['key' => $dynamicModel->getFileUrl(), 'caption' => $dynamicModel->getFileCaption(), 'size' => $dynamicModel->getFileSize(),],
                ],
                'layoutTemplates' => [
                  'actions' => '<div class="file-actions"><div class="file-footer-buttons">{other}</div></div>',
                ],
                'otherActionButtons' => '<button type="button" data-kv-cust-btn class="btn btn-sm btn-warning" style="display: none" {dataKey}><i class="glyphicon glyphicon-download"></i> Открыть</button>',/**/
              ],
            ]) ?>
          </td>
          <td>
            <?= $form->field($dynamicModel, "[$i]description")->label(false)->textarea(['rows' => 6]) ?>
          </td>

        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
      <tr>
        <td>
          <button type="button" class="doc-add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
        </td>
        <td colspan="2">
            <?= Html::submitButton('Сохранить документы', ['id' => 'doc-submit-btn', 'class' => 'btn btn-success']) ?>
        </td>
      </tr>
      </tfoot>
    </table>

    <?php DynamicFormWidget::end(); ?>
  </div>
<?php ActiveForm::end(); ?>

<?php
$js = <<<JS
jQuery('[data-kv-cust-btn]').show().on('click', function() {
        var btn = $(this), key = btn.data('key');
        window.open(key, '_blank');
    });
jQuery(".doc_dynamicform_wrapper").on("afterInsert", function (e, item) {
    jQuery(item).find('[data-krajee-fileinput]').fileinput('clear');
});
jQuery('#document-form').on('beforeSubmit', function (e) {
    var doc_submit_btn = jQuery("#doc-submit-btn");
    if(doc_submit_btn.length){
        doc_submit_btn.html(doc_submit_btn.html() + ' <i class="fa fa-spinner fa-spin"></i>');
    }
});
JS;
$this->registerJs($js);
?>