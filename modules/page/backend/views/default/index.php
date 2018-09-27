<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this \common\lib\View */
/* @var $searchModel modules\page\common\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Страницы";
$this->params['breadcrumbs'][] = $this->title;
$this->params['actions'] = [
    [
        'label' => 'Создать',
        'url' => Url::to(['create']),
        'type' => 'success',
        'icon' => 'la la-plus'
    ]
];
?>
<div class="page-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->title, ['update', 'id' => $model->id]);
                }
            ],
            [
                'class' => yii\grid\ActionColumn::class,
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
