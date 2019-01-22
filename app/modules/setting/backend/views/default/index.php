<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\setting\common\models\SettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">
    <div class="pull-right">
        <?= Html::a('<i class="fa fa-plus"></i> Новая настройка', ['create'], ['class' => 'btn green-meadow']) ?>
    </div>
    <div class="clearfix"></div>
    <br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'description:ntext',
            'section:ntext',
            'key',
            'value:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
