<?php

use kartik\daterange\DateRangePicker;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\bulletin\backend\models\BulletinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet__head">
  <div class="m-portlet__head-caption">
    <?= \backend\widgets\multipleDelete\MultipleDelete::widget([
      'gridId' => 'bulletin-grid',
    ]) ?>
  </div>
  <div class="m-portlet__head-tools">
    <ul class="m-portlet__nav">
      <li class="m-portlet__nav-item">
        <a href="<?= Url::to(['create']) ?>"
           class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
						<span>
							<i class="la la-plus"></i>
							<span>Создать</span>
						</span>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="m-portlet__body">
  <div class="dataTables_wrapper">
    <div class="row">
      <div class="col-sm-12">
        <?php Pjax::begin(['timeout' => 5000]); ?>
        <?= GridView::widget([
          'id' => 'bulletin-grid',
          'options' => ['class' => 'dataTable'],
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
            ['class' => \backend\lib\CheckboxColumn::class],
            [
              'attribute' => 'id',
              'filterOptions' => ['style' => 'width: 100px;']
            ],
            [
              'class' => \backend\lib\UpdateLinkColumn::class,
              'attribute' => 'title',
            ],
            [
              'class' => \backend\lib\UpdateLinkColumn::class,
              'idName' => 'client_id',
              'updateRoute' => '/client/default/update',
              'attribute' => 'client',
              'value' => 'client.title',
              'filterOptions' => ['style' => 'width: 200px;']
            ],
            [
              'attribute' => 'category_id',
              'filter' => \kartik\widgets\Select2::widget([
                'model' => $searchModel,
                'attribute' => 'category_id',
                'data' => \modules\bulletin\common\models\Category::getMap(),
                'options' => ['placeholder' => ''],
                'pluginOptions' => ['allowClear' => true],
              ]),
              'value' => 'category.name'
            ],
            [
              'attribute' => 'status_id',
              'filter' => \kartik\widgets\Select2::widget([
                'model' => $searchModel,
                'attribute' => 'status_id',
                'data' => \modules\bulletin\common\models\BulletinStatus::getMap(),
                'options' => ['placeholder' => ''],
                'pluginOptions' => ['allowClear' => true],
              ]),
              'value' => 'status.name'
            ],
            ['attribute' => 'created_at', 'format' => 'datetime', 'filterOptions' => ['class' => 'hide-filter-input']],
//            [
//              'attribute' => 'created_at',
//              'format' => ['date', 'dd.MM.yyyy HH:mm'],
//              'filter' => DateRangePicker::widget([
//                'model'=>$searchModel,
//                'attribute' => 'createdAt',
//                'convertFormat'=>true,
//                'startAttribute' => 'createdAtStart',
//                'endAttribute' => 'createdAtEnd',
//                'pluginOptions'=>[
////                  'locale'=>['format' => 'd.m.Y'],
//                  'format'=>'dd.mm.yyyy hh:ii',
//                ]
//              ])
//            ],
            ['class' => \backend\lib\ActionColumn::class],
          ],
        ]); ?>
        <?php Pjax::end(); ?>
      </div>
    </div>
  </div>
</div>
<?php
$this->registerCss('.hide-filter-input input{ display:none; }')
?>