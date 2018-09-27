<?php

use modules\lang\widgets\langActiveForm\ActiveForm;
use yii\helpers\Html;
use backend\widgets\crudActions\CrudActions;

/* @var $this \common\lib\View */
/* @var $model modules\page\common\models\Page */
/* @var $form backend\widgets\langActiveForm\LangActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
        'defaultLangInd' => $model->getDefaultLangInd(),
    ]); ?>

    <div class="pull-right">
        <div class="form-inline">
            <div class="form-group">
                <?= Html::dropDownList(null, $model->getDefaultLangInd(), $model->getLangMap(), [
                    'class' => 'form-control',
                    'id' => 'lang-dropdown',
                ]) ?>
                <?= CrudActions::widget([
                    'model' => $model,
                    'deleteConfirm' => 'Вы уверены, что хотите удалить этот объект?'
                ]); ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>

    <?= $form->field($model, 'thumb_id')->textInput() ?>

    <?= $form->field($model->variationModels, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->variationModels, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model->variationModels, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->variationModels, 'seo_description')->textInput(['maxlength' => true]) ?>


    <?php ActiveForm::end(); ?>

</div>
