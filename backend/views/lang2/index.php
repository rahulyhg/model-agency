<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Lang2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Langs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet">
  <div class="m-portlet__head">
    <div class="m-portlet__head-caption">
      <?php if ($title) : ?>
        <div class="m-portlet__head-title">
          <h3 class="m-portlet__head-text">
            <?= $title ?>
          </h3>
        </div>
      <?php endif; ?>
    </div>
    <div class="m-portlet__head-tools">
      <ul class="m-portlet__nav">
        <li class="m-portlet__nav-item">
          <a href="<?= Url::to(['create']) ?>"
             class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
						<span>
							<i class="la la-plus"></i>
							<span>Новая запись</span>
						</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="m-portlet__body">
    <div class="row">
      <div class="col-md-6">
        <?= \backend\widgets\multipleDelete\MultipleDelete::widget([
          'gridId' => 'lang-grid',
        ]) ?>
      </div>
    </div>
    <div class="dataTables_wrapper">
      <div class="row">
        <div class="col-sm-12">
  
    <?= GridView::widget([
        'id' => 'lang-grid',
        'options' => ['class' => 'dataTable'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => \backend\lib\CheckboxColumn::class],

            'id',
            'name',
            'label',
            'ietf_tag',
            'is_default',
            //'created_at',
            //'updated_at',

            ['class' => \backend\lib\ActionColumn::class],
        ],
    ]); ?>
        </div>
      </div>
    </div>
  </div>
</div>

