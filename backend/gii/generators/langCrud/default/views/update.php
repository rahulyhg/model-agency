<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \backend\gii\generators\langCrud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this \common\lib\SmBackendView */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = "<?= $generator->updatePageTitle ?: $generator->generateString('Обновить {modelClass}: ', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?>";
$this->params['breadcrumbs'][] = ['label' => <?= $generator->indexPageTitle ?: $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Обновление') ?>;
$this->iconClass = "<?= $generator->iconCssClass ?: 'fa fa-circle-thin' ?>";
$this->description = "<?= $generator->updatePageDescription ?: '' ?>";
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-update">

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
