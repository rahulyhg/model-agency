<?php

namespace backend\widgets\leadRange;

use backend\models\Lead;
use backend\models\LeadFunnel;
use backend\models\LeadFunnelColumn;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class LeadRange extends \yii\base\Widget
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
    $leads = ArrayHelper::index($this->getLeads(), null, ['column.leadFunnel.name', 'column.name']);
    return $this->render('@backend/widgets/leadRange/views/view', ['leads' => $leads]);
  }

  protected function getLeads($andWhere = null)
  {
    $query = Lead::find()->alias('l')->where([
      'between',
      'l.created_at',
      strtotime($this->startDate),
      strtotime($this->endDate) + 86399, //seconds in day - 1 (day end included)
    ])->joinWith(['column.leadFunnel lf']);
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