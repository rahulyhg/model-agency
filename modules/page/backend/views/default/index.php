<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this \common\lib\View */
/* @var $searchModel modules\page\common\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Страницы";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
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
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'attribute' => 'title',
                            'format' => 'raw',
                            'value' => function($model) {
                                return Html::a($model->title, ['update', 'id' => $model->id]);
                            }
                        ],
                        [
                            'class' => yii\grid\ActionColumn::class,
                            'template' => '{update} {delete}'
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
