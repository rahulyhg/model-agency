<?php

use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel modules\mod\common\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Country';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
      <?= \backend\widgets\multipleDelete\MultipleDelete::widget([
        'gridId' => 'country-grid',
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
<!--            <li class="m-portlet__nav-item">-->
<!--                <form action="--><?//= Url::to(['fill-country-from-json']) ?><!--" method="post">-->
<!--                    <input type="hidden" name="_csrf" value="--><?//=Yii::$app->request->getCsrfToken()?><!--" />-->
<!--                    <label for="fileJson">Input json file here</label>-->
<!--                    <input type="file" id="fileJson" name="fileJson">-->
<!--                    <input type="submit" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">-->
<!--                </form>-->
<!--            </li>-->
        </ul>
    </div>
</div>
<div class="m-portlet__body">
    <div class="dataTables_wrapper">
        <div class="row">
            <div class="col-sm-12">
              <?= GridView::widget(['id' => 'country-grid',
                'options' => ['class' => 'dataTable'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [['class' => \backend\lib\CheckboxColumn::class],
                  'id',
                  'tel_code',
                  ['class' => \backend\lib\ActionColumn::class],],]); ?>
            </div>
        </div>
    </div>
</div>
