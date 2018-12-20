<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\mod\common\models\ModSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mod';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
      <?= \backend\widgets\multipleDelete\MultipleDelete::widget([
        'gridId' => 'mod-grid',
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
              <?= GridView::widget([
                'id' => 'mod-grid',
                'options' => ['class' => 'dataTable'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                  ['class' => \backend\lib\CheckboxColumn::class],
                  'bust',
                  'waist',
                  'hips',
                  'eyes_color_id',
                  //'hair_color_id',
                  //'shoes',
                  //'created_at',
                  //'updated_at',
                  ['class' => \backend\lib\ActionColumn::class],
                ],
              ]); ?>
            </div>
        </div>
    </div>
</div>
