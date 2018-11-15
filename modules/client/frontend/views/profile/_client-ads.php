<?php
/**
 * @var $this \yii\web\View
 * @var $elementClass string
 * @var $activeBulletins \modules\bulletin\common\models\Bulletin[]
 * @var $notActiveBulletins \modules\bulletin\common\models\Bulletin[]
 */

use modules\client\Module;
?>
<div class="b-my-ads <?= $elementClass ?>">
  <ul class="b-my-ads__toggle-tabs">
    <li class="b-my-ads__toggle-tab">
      <a class="b-my-ads__toggle-tab-link" href="#activeAds"><?= Module::t('profile', 'Активные') ?></a>
    </li>

    <li class="b-my-ads__toggle-tab">
      <a class="b-my-ads__toggle-tab-link" href="#notActiveAds"><?= Module::t('profile', 'Неактивные') ?></a>
    </li>
  </ul>
  <ul class="b-my-ads__body-tabs">
    <li id="activeAds" class="b-my-ads__body-tab">
      <div class="b-my-ads__items">
        <?php
        if(count($activeBulletins) > 0) :
        foreach ($activeBulletins as $model) : ?>
          <?= \modules\bulletin\widgets\clientCard\ClientCard::widget([
            'model' => $model,
            'elementClass' => 'b-my-ads__item'
          ]) ?>
        <?php
        endforeach;
        else : ?>
          <p><?= Module::t('profile', 'Объявлений не найдено.') ?></p>
        <?php endif; ?>
      </div>
    </li>
    <li id="notActiveAds" class="b-my-ads__body-tab">
      <div class="b-my-ads__items">
        <?php
        if(count($notActiveBulletins) > 0) :
        foreach ($notActiveBulletins as $model) : ?>
          <?= \modules\bulletin\widgets\clientCard\ClientCard::widget([
            'model' => $model,
            'elementClass' => 'b-my-ads__item'
          ]) ?>
        <?php
        endforeach;
        else : ?>
          <p><?= Module::t('profile', 'Объявлений не найдено.') ?></p>
        <?php endif; ?>
      </div>
    </li>
  </ul>
</div>
