<?php
/**
 * @var $incomes float
 * @var $spending float
 */
?>
<div class="m-widget1">
  <div class="m-widget1__item">
    <div class="row m-row--no-padding align-items-center">
      <div class="col">
        <h3 class="m-widget1__title">Доходы</h3>
      </div>
      <div class="col m--align-right">
        <span class="m-widget1__number m--font-success"><?= Yii::$app->formatter->asDecimal($incomes) ?></span>
      </div>
    </div>
  </div>
  <div class="m-widget1__item">
    <div class="row m-row--no-padding align-items-center">
      <div class="col">
        <h3 class="m-widget1__title">Расходы</h3>
      </div>
      <div class="col m--align-right">
        <span class="m-widget1__number m--font-danger"><?= Yii::$app->formatter->asDecimal($spending) ?></span>
      </div>
    </div>
  </div>
</div>