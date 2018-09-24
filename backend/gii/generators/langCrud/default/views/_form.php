<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \backend\gii\generators\langCrud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$langModel = new $generator->langModelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}
$langSafeAttributes = $langModel->safeAttributes();
if (empty($langSafeAttributes)) {
    $langSafeAttributes = $langModel->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use backend\widgets\langActiveForm\LangActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this \common\lib\SmBackendView */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form backend\widgets\langActiveForm\LangActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = LangActiveForm::begin([
        'defaultLangInd' => $model->getDefaultLangInd(),
    ]); ?>

    <div class="pull-right">
        <div class="form-inline">
            <div class="form-group">
                <?= "<?=" ?> Html::dropDownList(null, $model->getDefaultLangInd(), $model->getLangMap(), [
                    'class' => 'form-control',
                    'id' => 'lang-dropdown',
                ]) ?>
                <?= "<?=" ?> CrudActions::widget([
                    'model' => $model,
                    'deleteConfirm' => 'Вы уверены, что хотите удалить этот объект?'
                ]); ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes) && $attribute !== 'date_create' && $attribute !== 'date_update') {
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
<?php foreach ($generator->getLangColumnNames() as $attribute) {
    if (in_array($attribute, $langSafeAttributes)) {
        echo "    <?= " . $generator->generateLangActiveField($attribute) . " ?>\n\n";
    }
} ?>

    <?= "<?php " ?>LangActiveForm::end(); ?>

</div>
