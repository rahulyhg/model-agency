<?php

namespace backend\widgets\moneyFlowRange;

use backend\models\MoneyFlow;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class MoneyFlowRange extends \yii\base\Widget
{
  const LAST_MONTH = 1;

  public $template = self::LAST_MONTH;

  public $startDate;
  public $endDate;

  public function init()
  {
    if(empty($this->startDate) || empty($this->endDate)){
      $this->initTemplate();
    } elseif(!strtotime($this->startDate) || !strtotime($this->endDate)) {
      throw new InvalidConfigException('Date format invalid');
    }
  }

  public function run()
  {
    return $this->render('@backend/widgets/moneyFlowRange/views/view', [
      'incomes' => array_sum(ArrayHelper::getColumn(
        $this->getMoneyFlows('amount > 0'),
        'amount'
      )),
      'spending' => array_sum(ArrayHelper::getColumn(
        $this->getMoneyFlows('amount < 0'),
        'amount'
      )),
    ]);
  }

  protected function getMoneyFlows($andWhere)
  {
    $query = MoneyFlow::find()->where([
      'between',
      'transaction_time',
      strtotime($this->startDate),
      strtotime($this->endDate) + 86399, //seconds in day - 1 (day end included)
    ]);
    if ($andWhere) {
      $query->andWhere($andWhere);
    }
    return $query->all();
  }

  protected function initTemplate()
  {
    switch($this->template) {
      case self::LAST_MONTH:
        $this->startDate = date('d.m.Y', strtotime('first day of this month', time()));
        $this->endDate = date('d.m.Y');
        break;
    }
  }
}