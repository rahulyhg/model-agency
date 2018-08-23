<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\banner\common\models\Banner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$formatter = \Yii::$app->formatter;
?>
<div class="banner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
          'confirm' => 'Are you sure you want to delete this item?',
          'method' => 'post',
        ],
      ]) ?>
    </p>

  <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
      'id',
      'name',
      'text:ntext',
      'position',
      [
        'attribute' => 'created_at',
        'value' => function ($model) {
          return \Yii::$app->formatter->asDatetime($model->created_at);
        }
      ],
      [
        'attribute' => 'updated_at',
        'value' => function ($model) {
          return \Yii::$app->formatter->asDatetime($model->updated_at);
        }
      ]
    ],
  ]) ?>

</div>
