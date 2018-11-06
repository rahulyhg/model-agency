<?php
/**
 * @var $model modules\bulletin\common\models\Bulletin
 */

use yii\helpers\Url;

$url = Url::to(['/bulletin/default/view', 'id' => $model->id]);
?>

<article class="b-first-announcement b-category-announcemen__item" itemscope itemtype="http://schema.org/Product">
  <header class="b-first-announcement__header">
    <a class="b-first-announcement__img-link" href="<?= $url ?>" title="<?= $model->title ?>">
      <img class="b-first-announcement__img" itemprop="image" src="<?= $model->thumbnailUrl ? : (Yii::$app->theme->getAssetsUrl($this) . '/img/no_photo.png') ?>"
           alt="<?= $model->title ?>">
    </a>
  </header>

  <main class="b-first-announcement__main">
    <div class="b-first-announcement__top">
      <a class="b-first-announcement__title-link" href="<?= $url ?>">
        <h3 class="b-first-announcement__title" itemprop="name"><?= $model->title ?></h3>
      </a>


      <p class="b-first-announcement__offer" itemprop="offers">
        <span class="b-first-announcement__price" itemprop="price" content="<?= $model->price ?>"><?= $model->price ?></span>
                                            <span class="b-first-announcement__currency" itemprop="priceCurrency"
                                                  content="UAH">грн</span>
      </p>
    </div>

    <p class="b-first-announcement__category">
      <?php foreach($model->category->parents as $parent) : ?>
      <span class="b-first-announcement__category-item"><?= $parent->name ?></span>
      <?php endforeach; ?>
      <span class="b-first-announcement__category-item" itemprop="category"><?= $model->category->name ?></span>
    </p>

    <div class="b-first-announcement__bottom">
                                        <span class="b-first-announcement__location"
                                              title="Киев, Киевская область, Украина">
                                            <i class="b-first-announcement__icon pe-7s-map-marker"></i>
                                            Киев, Киевская область
                                        </span>

      <time class="b-first-announcement__date" datetime="<?= date('Y-m-d', $model->created_at) ?>">
        <i class="b-first-announcement__icon pe-7s-clock"></i>
        <?= $model->formattedCreatedAt ?>
      </time>
    </div>
  </main>

</article>