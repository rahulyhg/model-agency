<?php

namespace backend\widgets\moneyFlowGrid;


use backend\models\MoneyFlowSearch;
use kartik\daterange\DateRangePicker;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

class MoneyFlowGrid extends Widget
{
  public $context_id;
  public $context_object_id;

  public function init()
  {
    parent::init();
    if (empty($this->context_id)) {
      throw new InvalidConfigException('"context_id" is required.');
    }
    if (empty($this->context_object_id)) {
      throw new InvalidConfigException('"context_object_id" is required.');
    }
  }

  public function run()
  {
    /* @var $searchModel \backend\models\MoneyFlowSearch */
    /* @var $dataProvider \yii\data\ActiveDataProvider */
    $searchModel = new MoneyFlowSearch(['context_id' => $this->context_id, 'context_object_id' => $this->context_object_id]);
    $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

    $financeBillMap = ArrayHelper::map(\backend\models\FinanceBill::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    $financeDirectionMap = ArrayHelper::map(\backend\models\FinanceDirection::find()->orderBy('name')->asArray()->all(), 'id', 'name');

    Pjax::begin(['id' => 'monew-flow-grid', 'timeout' => false, 'enablePushState' => false]);

    echo GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'tableOptions' => [
        'class' => 'table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline'
      ],
      'columns' => [
        [
          'attribute' => 'finance_direction_id',
          'filter' => $financeDirectionMap,
          'filterInputOptions' => ['prompt' => 'Все статьи', 'class' => 'form-control', 'id' => null],
          'value' => function ($data) {
            return $data->financeDirection->name;
          }
        ],
        [
          'attribute' => 'amount',
          'filter' => [0 => 'Доходы', -1 => 'Расходы'],
          'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control', 'id' => null],
        ],
        [
          'attribute' => 'finance_bill_id',
          'filter' => $financeBillMap,
          'filterInputOptions' => ['prompt' => 'Все счета', 'class' => 'form-control', 'id' => null],
          'value' => function ($data) {
            return $data->financeBill->name;
          }
        ],
        [
          'attribute' => 'transaction_time',
          'format' => ['date', 'dd.MM.yyyy'],
          'filter' => DateRangePicker::widget([
            'model' => $searchModel,
            'attribute' => 'transaction_time_range',
            'convertFormat' => true,
            'startAttribute' => 'transaction_time_start',
            'endAttribute' => 'transaction_time_end',
            'pluginOptions' => [
              'locale' => ['format' => 'd.m.Y'],
            ]
          ])
        ],
        [
          'attribute' => 'created_at',
          'format' => ['date', 'dd.MM.yyyy'],
          'filter' => DateRangePicker::widget([
            'model' => $searchModel,
            'attribute' => 'created_at_range',
            'convertFormat' => true,
            'startAttribute' => 'created_at_start',
            'endAttribute' => 'created_at_end',
            'pluginOptions' => [
              'locale' => ['format' => 'd.m.Y'],
            ]
          ])
        ],
      ],
    ]);
    Pjax::end();
  }
}