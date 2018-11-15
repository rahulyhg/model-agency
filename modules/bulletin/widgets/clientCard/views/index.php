<?php
/**
 * @var $this \yii\web\View
 * @var $model \modules\bulletin\common\models\Bulletin
 * @var $elementClass string
 */
use yii\helpers\Url;
use modules\bulletin\Module;
?>
<article class="b-first-announcement <?= $elementClass ?>" itemscope
         itemtype="http://schema.org/Product">
  <header class="b-first-announcement__header">
    <a class="b-first-announcement__img-link" href="<?= Url::to(['/bulletin/default/view', 'id' => $model->id]) ?>"
       title="<?= $model->title ?>">
      <img class="b-first-announcement__img" itemprop="image"
           src="<?= $model->thumbnailUrl ?>"
           alt="<?= $model->title ?>">
    </a>
  </header>
  <main class="b-first-announcement__main">
    <div class="b-first-announcement__top">
      <a class="b-first-announcement__title-link" href="<?= Url::to(['/bulletin/default/view', 'id' => $model->id]) ?>">
        <h3 class="b-first-announcement__title" itemprop="name"><?= $model->title ?></h3>
      </a>
      <p class="b-first-announcement__offer" itemprop="offers">
        <span class="b-first-announcement__price" itemprop="price" content="<?= $model->price ?>"><?= $model->price ?></span>
        <span class="b-first-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
      </p>
    </div>
    <p class="b-first-announcement__category">
      <span class="b-first-announcement__category-item"><?= $model->category->name ?></span>
      <?php foreach ($model->category->parents as $index => $parent) : ?>
        <span class="b-first-announcement__category-item"><?= $parent->name ?></span>
      <?php endforeach; ?>
    </p>
    <div class="b-first-announcement__bottom">
                <span class="b-first-announcement__location" title="<?= $model->location->name ?>">
                    <i class="b-first-announcement__icon pe-7s-map-marker"></i> <?= $model->location->name ?>
                </span>
      <time class="b-first-announcement__date" datetime="2018-10-09">
        <i class="b-first-announcement__icon pe-7s-clock"></i> <?= $model->formattedCreatedAt ?>
      </time>
    </div>
  </main>
  <footer class="b-first-announcement__footer">
    <div class="b-first-announcement__footer-left">
      <div class="b-first-announcement__views">
        <?= Module::t('client-card', 'Просмотров') ?>:
        <span class="b-first-announcement__views-value"><?= $model->bulletinStats[0]->views ?></span>
      </div>
    </div>
    <div class="b-first-announcement__footer-right">
      <ul class="b-first-announcement__actions">
        <?php if($model->status_id === \modules\bulletin\common\models\BulletinStatus::STATUS_NOT_ACTIVE) : ?>
          <li class="b-first-announcement__actions-item">
            <a href="<?= Url::to(['/bulletin/default/view', 'id' => $model->id]) ?>" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
              <?= Module::t('client-card', 'Просмотреть') ?>
            </a>
          </li>
          <li class="b-first-announcement__actions-item">
            <a href="<?= Url::to(['/client/profile/activation-bulletin', 'id' => $model->id]) ?>" class="b-first-announcement__actions-link b-first-announcement__actions-link_success">
              <?= Module::t('client-card', 'Активировать') ?>
            </a>
          </li>
        <?php else : ?>
          <li class="b-first-announcement__actions-item">
            <a href="<?= Url::to(['/bulletin/default/view', 'id' => $model->id]) ?>" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
              <?= Module::t('client-card', 'Просмотреть') ?>
            </a>
          </li>
          <li class="b-first-announcement__actions-item">
            <a href="<?= Url::to(['/bulletin/create/update-step1', 'id' => $model->id]) ?>" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
              <?= Module::t('client-card', 'Редактировать') ?>
            </a>
          </li>
          <li class="b-first-announcement__actions-item">
            <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
              <?= Module::t('client-card', 'Поднять') ?>
            </a>
          </li>
          <li class="b-first-announcement__actions-item">
            <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
              <?= Module::t('client-card', 'Выделить') ?>
            </a>
          </li>
          <li class="b-first-announcement__actions-item">
            <a href="<?= Url::to(['/client/profile/deactivation-bulletin', 'id' => $model->id]) ?>" class="b-first-announcement__actions-link b-first-announcement__actions-link_danger">
              <?= Module::t('client-card', 'Деактивировать') ?>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </footer>
</article>