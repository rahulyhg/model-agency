<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\imperavi\Widget;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $commentModel \yii2mod\comments\models\CommentModel */
/* @var $encryptedEntity string */
/* @var $formId string comment form id */
?>
<div class="comment-form-container">
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => $formId,
            'class' => 'comment-box',
        ],
        'action' => Url::to(['/comment/default/create', 'entity' => $encryptedEntity]),
        'validateOnChange' => false,
        'validateOnBlur' => false,
    ]); ?>

    <?php echo $form->field($commentModel, 'content', ['template' => '{input}{error}'])->textarea(['placeholder' => Yii::t('yii2mod.comments', 'Add a comment...'), 'rows' => 4, 'data' => ['comment' => 'content']]) ?>
<!--    --><?php //echo $form->field($commentModel, 'content', ['template' => '{input}{error}'])->widget(\vova07\imperavi\Widget::class, [
//      'settings' => [
//        'lang' => 'ru',
//        'minHeight' => 300,
//        'replaceDivs' => true,
//        'paragraphize' => false,
//        'imageUpload' => Url::to(['/deal/image-upload']),
//        'imageDelete' => Url::to(['/deal/file-delete']),
//        'imageManagerJson' => Url::to(['/deal/images-get']),
//      ],
//      'plugins' => [
//        'imagemanager' => \vova07\imperavi\bundles\ImageManagerAsset::class,
//      ],
//    ]); ?>
    <?php echo $form->field($commentModel, 'parentId', ['template' => '{input}'])->hiddenInput(['data' => ['comment' => 'parent-id']]); ?>
    <div class="comment-box-partial">
        <div class="button-container show">
            <?php echo Html::a(Yii::t('yii2mod.comments', 'Click here to cancel reply.'), '#', ['id' => 'cancel-reply', 'class' => 'pull-right', 'data' => ['action' => 'cancel-reply']]); ?>
            <?php echo Html::submitButton('Добавить', ['class' => 'btn btn-primary comment-submit']); ?>
        </div>
    </div>
    <?php $form->end(); ?>
    <div class="clearfix"></div>
</div>
