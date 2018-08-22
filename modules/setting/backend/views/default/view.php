<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model modules\setting\common\models\Setting */

$this->title = $model->section . '.' . $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="portlet setting-view">
    <div class="portlet-title">
        <div class="actions">
            <?= Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-icon-only blue']) ?>
            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-icon-only red',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить эту настройку навсегда? Это может разрушить мир! :)',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <div class="portlet-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'key',
                'value:ntext',
                'section:ntext',
                'description:ntext',
                [
                    'attribute' => 'date_create',
                    'value' => Yii::$app->formatter->asDatetime($model->date_create),
                ],
                [
                    'attribute' => 'date_update',
                    'value' => Yii::$app->formatter->asDatetime($model->date_update),
                ],
            ],
        ]) ?>
    </div>
</div>