<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel modules\location\backend\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Населенные пункты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet__head">
  <div class="m-portlet__head-caption">
    <?= \backend\widgets\multipleDelete\MultipleDelete::widget([
      'gridId' => 'location-grid',
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
            <?php Pjax::begin(); ?>
                  <?= GridView::widget([
          'id' => 'location-grid',
          'options' => ['class' => 'dataTable'],
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
        'columns' => [
          ['class' => \backend\lib\CheckboxColumn::class],
                      'id',
          ['class' => \backend\lib\ActionColumn::class],
          ],
          ]); ?>
                    <?php Pjax::end(); ?>
      </div>
    </div>
  </div>
</div>
