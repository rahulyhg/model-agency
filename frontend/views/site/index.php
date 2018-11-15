<?php

/* @var $this yii\web\View */

/* @var $lastBulletins \modules\bulletin\common\models\Bulletin[] */

use \modules\bulletin\widgets\verticalCard\VerticalCard;
use \modules\bulletin\common\models\Bulletin;

$this->title = Yii::t('home-page', 'Доска объявлений');
$this->params['showSearchForm'] = true;
$this->params['showCategories'] = true;
?>
<!-- b-content -->
<div class="b-content b-main__content">
  <!-- b-recent-announcements -->
  <section class="b-recent-announcements b-content__item">
    <header class="b-recent-announcements__header">
      <h2 class="b-title b-recent-announcements__title">
        <?= Yii::t('home-page', 'Последние объявления') ?>
      </h2>
    </header>
    <main class="b-recent-announcements__main">
      <?php foreach ($lastBulletins as $lastBulletin) : ?>
        <?= VerticalCard::widget([
          'model' => $lastBulletin,
          'elementClass' => 'b-recent-announcements__item'
        ]) ?>
      <?php endforeach; ?>

      <?= Yii::$app->banner->get('home_inside_recent_ads') ?>
    </main>
  </section>
  <!-- b-recent-announcements -->
</div>
<!-- b-content end -->