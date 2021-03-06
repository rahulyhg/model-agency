<?php

use conquer\codemirror\CodemirrorAsset;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\banner\common\models\Banner */
/* @var $form yii\widgets\ActiveForm */

$codeMirrorOptions = [
    'assets' => [
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
    'settings' => [
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
            "Ctrl-/" => "toggleComment",
            "Ctrl-Space" => "autocomplete"
        ],
        'theme' => "base16-dark",
    ],
];
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin([
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
                        <?= \backend\widgets\crudActions\CrudActions::widget([
                            'model' => $model
                        ]) ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'position')->textInput(['maxlength' => true, 'disabled' => $model->isNewRecord ? null : 'disabled']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'text')->widget(\conquer\codemirror\CodemirrorWidget::class, $codeMirrorOptions) ?>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->

    <?php ActiveForm::end(); ?>

</div>