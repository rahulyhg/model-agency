<?php
/**
 * @var $this \yii\web\View
 * @var $model \modules\bulletin\common\models\Bulletin
 */

use yii\helpers\Url;

?>
<article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
  <header class="b-second-announcement__header">
    <a class="b-second-announcement__img-link" href="<?= Url::to(['/bulletin/default/view', 'id' => $model->id]) ?>" title="Велосипед горный">
      <img class="b-second-announcement__img" itemprop="image" src="<?= $model->thumbnailUrl ?>" alt="<?= $model->title ?>">
    </a>
  </header>
  <main class="b-second-announcement__main">
    <a class="b-second-announcement__title-link" href="<?= Url::to(['/bulletin/default/view', 'id' => $model->id]) ?>">
      <h3 class="b-second-announcement__title" itemprop="name"><?= $model->title ?></h3>
    </a>
    <p class="b-second-announcement__category" itemprop="category">
      <?php foreach ($model->category->parents as $index => $parent) : ?>
        <?= $parent->name ?>
        <?php if ($index !== 0) : ?> » <?php endif; ?>
      <?php endforeach; ?>
      <!--<?php if ($model->category->parents) : ?> / <?php endif; ?>-->
      <?= $model->category->name ?>
    </p>
    <?php if ($model->price) : ?>
      <p class="b-second-announcement__offer" itemprop="offers">
        <span class="b-second-announcement__price" itemprop="price" content="<?= $model->price ?>"><?= $model->price ?></span>
        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
      </p>
    <?php endif; ?>
  </main>
  <footer class="b-second-announcement__footer">
    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
      <i class="b-second-announcement__icon pe-7s-map-marker"></i>
      <?= $model->location->name ?>
    </span>
    <time class="b-second-announcement__date" datetime="<?= Yii::$app->formatter->asDate($model->created_at, 'Y-m-d') ?>">
      <i class="b-second-announcement__icon pe-7s-clock"></i>
      <?= $model->formattedCreatedAt ?>
    </time>
  </footer>
</article>
