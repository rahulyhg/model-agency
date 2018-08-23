<?php

use backend\widgets\crudButtons\CrudButtons;
use conquer\codemirror\CodemirrorAsset;
use conquer\codemirror\CodemirrorWidget;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\block\common\models\Block */
/* @var $form yii\widgets\ActiveForm */


$codeMirrorOptions = [
  'assets'=>[
    CodemirrorAsset::ADDON_SEARCH,
    CodemirrorAsset::ADDON_HINT_HTML_HINT,
    CodemirrorAsset::ADDON_EDIT_CLOSEBRACKETS,
    CodemirrorAsset::ADDON_EDIT_CLOSETAG,
    CodemirrorAsset::ADDON_EDIT_MATCHTAGS,
    CodemirrorAsset::ADDON_FOLD_MARKDOWN_FOLD,
    CodemirrorAsset::ADDON_FOLD_XML_FOLD,
    CodemirrorAsset::ADDON_HINT_XML_HINT,
    CodemirrorAsset::ADDON_MODE_SIMPLE,
    CodemirrorAsset::ADDON_COMMENT,
    CodemirrorAsset::ADDON_DISPLAY_FULLSCREEN,
    CodemirrorAsset::ADDON_CONTINUECOMMENT,
    CodemirrorAsset::ADDON_DISPLAY_PANEL,
    CodemirrorAsset::ADDON_DISPLAY_PLACEHOLDER,
    CodemirrorAsset::ADDON_DISPLAY_RULERS,
    CodemirrorAsset::ADDON_EDIT_CONTINUELIST,
    CodemirrorAsset::ADDON_EDIT_MATCHBRACKETS,
    CodemirrorAsset::ADDON_EDIT_MATCHTAGS,
    CodemirrorAsset::ADDON_RUNMODE_COLORIZE,

    CodemirrorAsset::MODE_CLIKE,
    CodemirrorAsset::MODE_PHP,
    CodemirrorAsset::MODE_JAVASCRIPT,
    CodemirrorAsset::MODE_MARKDOWN,
    CodemirrorAsset::MODE_XML,
    CodemirrorAsset::MODE_CSS,
    CodemirrorAsset::MODE_HTMLEMBEDDED,
    CodemirrorAsset::MODE_HTMLMIXED,

    CodemirrorAsset::THEME_BASE16_DARK,
  ],
  'settings'=>[
    'lineNumbers' => true,
    'matchBrackets' => true,
    'continueComments' => "Enter",
    'mode' => "htmlmixed",
    'indentUnit' => 4,
    'indentWithTabs' => true,
    'viewportMargin' => 20,
    'extraKeys' => [
      "F11" => new JsExpression("function(cm){cm.setOption('fullScreen', !cm.getOption('fullScreen'));}"),
      "Esc" => new JsExpression("function(cm){if(cm.getOption('fullScreen')) cm.setOption('fullScreen', false);}"),
      "Ctrl-/"=> "toggleComment",
      "Ctrl-Space" => "autocomplete"
    ],
    'theme' => "base16-dark",
  ],
];
?>

<div class="block-form">

    <?php $form = ActiveForm::begin([
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
    ]); ?>

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
                        <?= $this->title ?>
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
                    <?= $form->field( $model, 'key' )->textInput( [ 'maxlength' => true, 'disabled' => $model->isNewRecord ? null : 'disabled' ] ) ?>
                    <div class="codemirror_height-800">
                    <?= $form->field( $model, 'content' )->widget(\conquer\codemirror\CodemirrorWidget::className(), $codeMirrorOptions) ?>
                      <?php $this->registerCss('.codemirror_height-800 .CodeMirror { height: 800px; }') ?>
                    </div>
                </div>
                <div class="col-md-4">
                  <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                  <?= $form->field($model, 'css')->widget(\conquer\codemirror\CodemirrorWidget::className(), $codeMirrorOptions) ?>
                  <?= $form->field($model, 'js')->widget(\conquer\codemirror\CodemirrorWidget::className(), $codeMirrorOptions) ?>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
