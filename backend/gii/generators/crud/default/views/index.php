<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \backend\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this \common\lib\SmBackendView */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "<?= $generator->indexPageTitle ?: $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>";
$this->params['breadcrumbs'][] = $this->title;
$this->iconClass = "<?= $generator->iconCssClass ?: 'fa fa-circle-thin' ?>";
$this->description = "<?= $generator->indexPageDescription ?: '' ?>";
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

<?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

    <div class="pull-right">
        <?= "<?=" ?> Html::a('<i class="fa fa-plus"></i> <?=$generator->createButtonText?>', ['create'], ['class' => 'btn green-meadow']) ?>
    </div>

    <div class="clearfix"></div>
    <br>

<?= $generator->enablePjax ? '<?php Pjax::begin(); ?>' : '' ?>
<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?= " ?>GridView::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (   $column->name == 'date_create'
            || $column->name == 'date_update'
            || $column->name == 'id'
            || strpos($column->name, '_id') !== false
            || strpos($column->name, 'seo') !== false
            || $column->dbType == 'text') {
            echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            continue;
        }
        if (++$count < 6) {
            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
    if($count < 6) {
        $langTableScheme = $generator->getLangTableSchema();
        foreach ($langTableScheme->columns as $column) {
            $format = $generator->generateColumnFormat($column);
            if (   $column->name == 'date_create'
                || $column->name == 'date_update'
                || $column->name == 'id'
                || strpos($column->name, '_id') !== false
                || strpos($column->name, 'seo') !== false
                || $column->dbType == 'text') {
                echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                continue;
            }
            if (++$count < 6) {
                echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            } else {
                echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        }
    }
}
?>

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>
<?= $generator->enablePjax ? '<?php Pjax::end(); ?>' : '' ?>
</div>
