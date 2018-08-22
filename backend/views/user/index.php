<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this \backend\lib\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Users';
$this->showTitle               = false;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

  <div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
      <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
          <span class="m-portlet__head-icon">
            <i class="la la-money"></i>
          </span>
          <h3 class="m-portlet__head-text">
            Users
          </h3>
        </div>
      </div>
      <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
          <li class="m-portlet__nav-item">
            <a href="<?= Url::to( [ 'create' ] ) ?>"
               class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
						<span>
							<i class="la la-plus"></i>
							<span>Create</span>
						</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="m-portlet__body">
      <div id="m_table_1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
        <div class="row">
          <div class="col-sm-12">
			  <?= GridView::widget( [
				  'dataProvider' => $dataProvider,
				  'filterModel'  => $searchModel,
				  'columns'      => [
            [
                'label' => 'Photo',
                'format' => 'raw',
                'value' => function($model) {
			            return Html::a(Html::img($model->photoUrl, [
			                'style' => 'width:100%; max-width: 75px; height: auto;'
                  ]), Url::to(['update', 'id' => $model->id]));
                },
                'options' => [
                    'style' => 'width:75px'
                ]
            ],
					  'username',
					  'email',
					  [ 'class' => \backend\lib\ActionColumn::class ],
				  ],
			  ] ); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
