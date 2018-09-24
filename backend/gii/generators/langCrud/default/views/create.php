<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \backend\gii\generators\langCrud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;


/* @var $this \common\lib\SmBackendView */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = "<?= $generator->createPageTitle ?: $generator->generateString('Создать ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>";
$this->params['breadcrumbs'][] = ['label' => <?= $generator->indexPageTitle ?: $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->iconClass = "<?= $generator->iconCssClass ?: 'fa fa-circle-thin' ?>";
$this->description = "<?= $generator->createPageDescription ?: '' ?>";
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
