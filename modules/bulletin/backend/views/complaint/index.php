<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel modules\bulletin\backend\models\ComplaintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Жалобы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet__head">
  <div class="m-portlet__head-caption">
    <?= \backend\widgets\multipleDelete\MultipleDelete::widget([
      'gridId' => 'complaint-grid',
    ]) ?>
  </div>
  <div class="m-portlet__head-tools">
    <ul class="m-portlet__nav">
      <li class="m-portlet__nav-item">
<!--        <a href="--><?//= Url::to(['create']) ?><!--"-->
<!--           class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">-->
<!--						<span>-->
<!--							<i class="la la-plus"></i>-->
<!--							<span>Создать</span>-->
<!--						</span>-->
<!--        </a>-->
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
          'id' => 'complaint-grid',
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
            'attribute' => 'subject',
          ],
          [
            'class' => \backend\lib\UpdateLinkColumn::class,
            'updateRoute' => '/bulletin/default/update',
            'attribute' => 'entity_id',
            'filter' => \kartik\widgets\Select2::widget([
              'model' => $searchModel,
              'attribute' => 'entity_id',
              'data' => \modules\bulletin\common\models\Bulletin::getMap(),
              'options' => ['placeholder' => ''],
              'pluginOptions' => ['allowClear' => true],
            ]),
            'value' => 'entity.shortTitle'
          ],
          [
            'attribute' => 'status_id',
            'filter' => \kartik\widgets\Select2::widget([
              'model' => $searchModel,
              'attribute' => 'status_id',
              'data' => \modules\bulletin\common\models\Bulletin::getMap(),
              'options' => ['placeholder' => ''],
              'pluginOptions' => ['allowClear' => true],
            ]),
            'value' => 'status.name'
          ],
          ['attribute' => 'created_at', 'format' => 'datetime', 'filterOptions' => ['class' => 'hide-filter-input']],
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