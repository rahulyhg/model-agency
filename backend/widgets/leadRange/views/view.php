<?php
/**
 * @var $leads
 */
use yii\helpers\ArrayHelper;

?>
<div class="m-widget1">
  <?php foreach ($leads as $funnel => $funnelLeads) : ?>
    <div class="m-widget1__item">
      <div class="row m-row--no-padding align-items-center">
        <div class="col">
          <h3 class="m-widget1__title"><?= $funnel ?></h3>
          <?php foreach ($funnelLeads as $column => $columnLeads) : ?>
          <div class="col">
            <span class="m-widget1__desc"><?= $column ?> - </span>
            <span class="m-widget1__number m--font-danger"><?= count($columnLeads) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>