<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\bulletin\backend\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--  <div class="m-portlet__head">-->
<!--    <div class="m-portlet__head-caption">-->
<!--      --><?///*= \backend\widgets\multipleDelete\MultipleDelete::widget([
//        'gridId' => 'service-grid',
//      ])/**/ ?>
<!--    </div>-->
<!--    <div class="m-portlet__head-tools">-->
<!--      <ul class="m-portlet__nav">-->
<!--        <li class="m-portlet__nav-item">-->
<!--                  <a href="--><?//= Url::to(['create']) ?><!--"-->
<!--                     class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">-->
<!--          						<span>-->
<!--          							<i class="la la-plus"></i>-->
<!--          							<span>Создать</span>-->
<!--          						</span>-->
<!--                  </a>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
<!--  </div>-->
  <div class="m-portlet__body">
    <div class="dataTables_wrapper">
      <div class="row">
        <div class="col-sm-12">
          <?php unset($searchModel->attributes['duration']);
          Pjax::begin(); ?>
          <?= GridView::widget([
            'id' => 'service-grid',
            'options' => ['class' => 'dataTable'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
//              ['class' => \backend\lib\CheckboxColumn::class],
              [
                'attribute' => 'id',
                'filterOptions' => ['style' => 'width: 100px;']
              ],
              [
                'class' => \backend\lib\UpdateLinkColumn::class,
                'attribute' => 'name',
              ],
              ['attribute' => 'duration', 'filterOptions' => ['class' => 'hide-filter-input']],
              ['attribute' => 'price', 'format' => 'decimal', 'filterOptions' => ['class' => 'hide-filter-input']],
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