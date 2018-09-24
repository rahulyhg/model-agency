<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator \backend\gii\generators\langCrud\Generator */
;
echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'langModelClass');
echo $form->field($generator, 'searchModelClass');
echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'viewPath');
echo $form->field($generator, 'baseControllerClass');
echo $form->field($generator, 'indexWidgetType')->dropDownList([
    'grid' => 'GridView',
    'list' => 'ListView',
]);
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'enablePjax')->checkbox();
echo $form->field($generator, 'messageCategory');
echo '<hr/><h3>View options:</h3>';
echo $form->field($generator, 'iconCssClass')->label('Icon CSS-class');
echo $form->field($generator, 'indexPageTitle');
echo $form->field($generator, 'indexPageDescription')->textarea();
echo $form->field($generator, 'createPageTitle');
echo $form->field($generator, 'createPageDescription')->textarea();
echo $form->field($generator, 'updatePageTitle');
echo $form->field($generator, 'updatePageDescription')->textarea();
echo $form->field($generator, 'createButtonText');
echo $form->field($generator, 'singularEntityName');