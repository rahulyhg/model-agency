<?php
/**
 * @var $this \yii\web\View
 * @var $model \modules\bulletin\common\models\Bulletin
 * @var $stat \modules\bulletin\common\models\BulletinStat
 */
$this->registerJs('
$(document).ready(function () {
    $(\'.b-single-announcemen__slides\').slick({
        arrows: true,
        infinite: false,
        speed: 200,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $(\'.b-single-announcemen__slider-arrow_left\'),
        nextArrow: $(\'.b-single-announcemen__slider-arrow_right\')
    });
    
    $("#showNumberBtn").click(function(e) {
      $.ajax({
        method: "GET",
        url: "'.\yii\helpers\Url::to(['/bulletin/default/get-phone']).'",
        data: { id: '.$model->id.' }
      }).done(function( response ) {
        $("#phone-container").html(response)
      });
    });
});
');
?>
<?= Yii::$app->banner->get('single_adv_top') ?>

<!-- b-content -->
<div class="b-content b-main__content b-main__content_sidebar">

  <!-- b-single-announcemen -->
  <section class="b-single-announcement b-content__item">
    <header class="b-single-announcemen__header">
      <?php if( $model->bulletinImages ) : ?>
      <div class="b-single-announcemen__slider">
        <div class="b-single-announcemen__slides">
          <?php foreach ($model->bulletinImages as $bulletinImage) : ?>
            <a class="b-single-announcemen__img-link" href="<?= $bulletinImage->imageUrl ?>" data-fancybox="gallery">
              <img class="b-single-announcemen__img" src="<?= $bulletinImage->imageUrl ?>" alt="<?= $bulletinImage->imageCaption ?>">
            </a>
          <?php endforeach; ?>
        </div>

        <div class="b-single-announcemen__slider-arrow b-single-announcemen__slider-arrow_left"
             title="Предыдущее фото товара">
          <i class="b-single-announcemen__slider-arrow-icon pe-7s-angle-left"></i>
        </div>

        <div class="b-single-announcemen__slider-arrow b-single-announcemen__slider-arrow_right"
             title="Следующее фото товара">
          <i class="b-single-announcemen__slider-arrow-icon pe-7s-angle-right"></i>
        </div>
      </div>
      <?php endif; ?>

      <div class="b-single-announcemen__header-inner">
        <div class="b-single-announcemen__top-line">
                                    <span class="b-single-announcemen__location" title="<?= $model->location->name ?>">
                                        <i class="b-single-announcemen__top-line-icon pe-7s-map-marker"></i>
                                        <?= $model->location->name ?>
                                    </span>

          <time class="b-single-announcemen__date" datetime="<?= Yii::$app->formatter->asDate($model->created_at, 'Y-m-d') ?>">
            <i class="b-single-announcemen__top-line-icon pe-7s-clock"></i>
            <?= $model->formattedCreatedAt ?>
          </time>
        </div>

        <h1 class="b-single-announcemen__title"><?= $model->title ?></h1>

        <h2 class="b-single-announcemen__category">
          <span class="b-single-announcemen__category-item"><?= $model->category->name ?></span>
          <?php foreach ($model->category->parents as $index => $parent) : ?>
            <span class="b-single-announcemen__category-item"><?= $parent->name ?></span>
          <?php endforeach; ?>
        </h2>

        <ul class="b-single-announcemen__params">
          <li class="b-single-announcemen__params-item">
            <span class="b-single-announcemen__params-name">Объявление от</span>
            <span class="b-single-announcemen__params-value">Частного лица</span>
          </li>
          <li class="b-single-announcemen__params-item">
            <span class="b-single-announcemen__params-name">Вид товара</span>
            <span class="b-single-announcemen__params-value">Вело</span>
          </li>
          <li class="b-single-announcemen__params-item">
            <span class="b-single-announcemen__params-name">Подкатегории</span>
            <span class="b-single-announcemen__params-value">Велосипеды</span>
          </li>
          <li class="b-single-announcemen__params-item">
            <span class="b-single-announcemen__params-name">Состояние</span>
            <span class="b-single-announcemen__params-value">Б/У</span>
          </li>
        </ul>
      </div>

    </header>

    <main class="b-single-announcemen__main">
      <?= $model->content ?>
    </main>

    <footer class="b-single-announcemen__footer">
      <div class="b-single-announcemen__view-count">
        Просмотров объявления:
        <span class="b-single-announcemen__view-count-value"><?= $stat->views ?></span>
      </div>
    </footer>
  </section>
  <!-- b-single-announcemen end -->

  <?= Yii::$app->banner->get('single_adv_bottom') ?>
</div>
<!-- b-content end -->

<!-- b-sidebar -->
<div class="b-sidebar b-main__sidebar">
  <div class="b-seller-info b-sidebar__seller-info">
    <div class="b-seller-info__top">
      <p class="b-seller-info__offer">
                                <span class="b-seller-info__price" itemprop="price" content="7599.00">
                                    7 599
                                </span>
        <span class="b-seller-info__currency" itemprop="priceCurrency" content="UAH">
                                    грн
                                </span>
      </p>
      <div class="b-seller-info__photo">
        <svg id="user-default" class="b-seller-info__photo-img" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 5100.6 5267.6"
             style="enable-background:new 0 0 5100.6 5267.6;" xml:space="preserve">
                                    <g>
                                      <path d="M914.8,3876.6c75.4-216.8,234.5-354.7,234.5-354.7c56.5-49.6,119.8-88.1,190.2-115.4c61.5-23.9,124.7-39.4,189.4-52.3
                                            c61.5-12.2,123-25.9,183.7-42.8c62-17.3,123.5-35.8,184.3-56.3c20.6-7,40.6-16.2,60.5-25.5c15.8-7.4,26.9-5.2,36.2,10.5
                                            c66.7,111.7,133.9,223,200.8,334.5c51,85.2,101.8,170.5,152.6,255.8c5.2,8.8,9,18.4,14.1,27.4c2.4,4.2,6.3,7.9,11.8,6.4
                                            c4.6-1.3,5.2-5.9,5.7-10c8.7-57.5,28.4-112.6,36-170.4c0.2-2,0.9-4,1.5-6c11.5-41.5,10.6-40.6-22-68.6
                                            c-53.3-45.5-80.3-105.1-84.5-174.4c-2.1-35.4,9.6-40.8,43.8-32.5c41.9,10.1,84.5,19.7,127.3,22.1c63.5,3.6,127.7,8,190.6-6.9
                                            c30.6-7.3,62.5-7,92.8-17.8c18.4-6.6,30.9,6.1,30.2,30c-1.4,47.6-15.3,91.8-41.9,131.3c-16.5,24.6-36.9,46.1-61.2,63.2
                                            c-14.2,9.9-15.2,20.6-10.5,37.1c11.1,39.5,20.3,79.5,27.6,119.8c4.7,25.6,18.4,49,18,75.8c-0.1,3.2,2.5,6.6,6.7,6.6
                                            c6.6-0.1,9-5.7,11.7-10.3c17.8-30.1,35.1-60.4,52.9-90.4c31-52.4,62.1-104.9,93.4-157.2c31.9-53.5,64.2-106.7,96.1-160.2
                                            c41.4-69.4,82.5-138.8,123.6-208.3c7.9-13.3,19.3-15.6,31.7-9.2c48.9,25.4,101.4,41.6,153.6,57.3c49.6,15,99.9,28,150.5,40.2
                                            c79.9,19.3,161.8,29.7,240.6,52.8c137.4,40.2,254.1,113.5,346.3,224.6c7.8,9.4,91.9,108.4,142.9,243.5
                                            c10.6,28.2,19.4,56.9,22.2,93.1c1.6,20.3,4.4,58-8.7,97.2c-22,65.7-75.9,102.4-122.9,129.4c-45.2,26.1-93.7,44.5-143.1,60.7
                                            c-49.3,16.2-99.9,28.8-150.6,39.2c-44.8,9.2-90.2,16.5-135.3,24.8c-57.4,10.5-115.3,18.2-172.9,23.5
                                            c-101.5,9.3-202.6,25.9-305.2,22.9c-12.3-0.3-1212-0.7-1228.4-0.2c-92.2,3.1-182.8-16.5-274.5-19.7c-33.2-1.1-64.7-11.5-97.6-13.9
                                            c-64.3-4.8-127.5-17-190.5-29.9c-35.5-7.3-70.9-15-106.2-23.4c-27.9-6.7-56-13-83-22.6c-37.2-13.3-74.5-26.4-110.3-43.6
                                            c-48.1-23.2-126.2-66.4-155.9-149c-14.4-40.1-13.4-78.7-13-86.3C901.6,3919.2,908.2,3895.8,914.8,3876.6z" />
                                      <path d="M2770.8,959.2c54,13.3,127.4,29.7,212.2,77.7c66.1,37.4,126.3,82.4,181.2,134.3c53.4,50.5,99,108.1,138.9,170
                                            c46.5,72.4,81.6,149.7,107.3,232.1c38.9,124.5,52.4,251.6,47.3,381.3c-0.3,8.2-1.3,16.5-3.2,24.5c-8.8,36.8,14.7,63.6,27.9,93.8
                                            c13.8,31.4,24.2,63.6,25.6,98.7c2.6,70.8-12.1,138.5-29.7,206.5c-16.3,62.9-39.7,122.3-73.5,177.4c-15.3,25-34.3,47.9-56,68.2
                                            c-22.6,21.2-40.5,43-48.5,75.8c-10.8,44.2-30.4,86.5-51.4,127.4c-27.8,54.2-55.5,109.1-96.1,155c-80,90.4-161.1,180.3-264.8,244.9
                                            c-62.4,38.9-129.2,70.3-201.2,85.9c-72.2,15.6-144.5,26.4-219.7,7.5c-51-12.8-103.1-21-152.5-39.7c-38.4-14.7-74.4-34.7-109-57.1
                                            c-118.2-76.4-220.3-169.7-295.8-289.5c-29.9-47.4-56.2-97-78-148.9c-14.6-34.7-29.4-69.1-38.7-105.8c-3.8-15-12.5-27.2-24.1-37.5
                                            c-74.2-66.1-115.4-151.1-142.4-245c-18.9-66.1-34.3-132.5-34.2-201.7c0.1-58.8,11.1-114.3,48-162c4-5.2,5.3-11.1,5.2-17.4
                                            c-0.6-35-2.2-70.1-1.1-104.9c1.9-65.6-2.2-131.4,10.8-196.8c11.4-57.2,22.9-114.2,42.5-169c17-47.6,36.9-94,60.9-138.9
                                            c30.9-57.9,66.8-112,109.4-161.3c61.6-71.3,130.2-134.7,210.7-185.1c49.1-30.7,99.7-57.7,154.1-76.3c33.2-11.4,58.3-16.7,89.1-23.3
                                            c66.1-14.2,135.7-29.2,224.8-29.6C2646.7,929.3,2721.5,947.2,2770.8,959.2z M2798.8,1857.4c-3.9,5.4,0.3,9.2,2.5,13.2
                                            c39.4,74.3,78.9,148.6,118.5,222.7c4.3,7.9,10.2,15.9,4,24.7c-6.8,9.8-17.2,6.7-26.4,4.4c-15.2-3.9-30.1-9.7-45.5-12.8
                                            c-45.1-9.3-88.1-25.1-130.5-41.9c-55.1-21.8-108.7-47.3-161-75.7c-71.8-38.9-139.8-83.2-205-132c-57.1-42.7-111.9-88.4-164.7-136.4
                                            c-10.9-9.9-22.3-11.3-36-9.3c-44.9,6.7-81,30.6-111.1,61.8c-52.6,54.6-80.9,123.4-99,195.7c-9.6,38.3-17.9,77-21.6,116.9
                                            c-5.5,58-16.5,115.3-11.8,174.1c0.9,10.8-1,21.9-2,32.8c-0.7,7-2.7,14.7-11.1,15.2c-9.9,0.6-11.3-7.9-12.9-15.6
                                            c-10.6-51-30.5-99.3-44.5-149.3c-5.6-19.9-19.2-22.5-36.5-21.1c-18.1,1.5-27.1,12.5-29.7,28.8c-2.4,14.8-4.3,30.1-3.7,45
                                            c3.9,93.1,27.1,181.1,73,262.4c17.5,31,42.3,56,79.3,63.7c14.8,3.1,19.4,13.2,21.9,26.2c7.3,39.7,18,78.5,30.4,117.1
                                            c21.9,68.6,56.3,130.8,95.1,190.3c52.3,80.3,116.2,150.4,197.2,203.9c45.4,30,93.1,54.6,143.9,73.5
                                            c64.8,24.1,132.2,19.8,199.4,18.1c10.8-0.2,21.7-3.4,32.2-6.2c52.8-14.5,104-33.2,151.1-61.9c60.5-37,117.5-78.6,163.7-132.8
                                            c27-31.7,51.2-66,74.8-100.5c41.6-60.7,72.1-126.9,96.6-196.4c12.5-35.2,15.1-72.5,27.1-107.6c4.4-12.9,10.8-20.8,24.6-24.4
                                            c27.5-7.3,48.4-24.3,64.6-47.8c25.8-37.7,43.6-78.5,55.9-122.6c16.4-58.9,32-117.6,28.9-179.5c-1.7-33-14.3-46.9-46.7-49.2
                                            c-17.9-1.2-24.2-10.4-22-27.2c0.9-6.8,2.1-13.5,2.6-20.4c0.3-4.1,0.1-8.9-5-10c-3.7-0.7-5.9,2.8-7.7,5.7
                                            c-6.1,10-11.6,20.3-18.2,29.9c-10.9,15.5-23.7,26.4-45,19.2c-64.1-21.4-123.5-52.1-178.7-90.5c-70.4-49.1-136.8-103.2-196-165.7
                                            C2809.7,1861.9,2806.4,1855.4,2798.8,1857.4z" />
                                    </g>
                                </svg>
      </div>
    </div>

    <div class="b-seller-info__bottom">
      <p class="b-seller-info__name">
        <?= $model->client->name ?>
      </p>

      <p class="b-seller-info__number">
        <span class="b-seller-info__number-beginning" id="phone-container">+38 (067) 614 ****</span>
      </p>

      <a class="b-seller-info__number-request" id="showNumberBtn" href="javascript:void(0);" title="Нажмите что бы увидеть полный номер продавца!">Показать номер</a>
    </div>
  </div>

  <?= Yii::$app->banner->get('single_adv_right') ?>
</div>
<!-- b-sidebar end -->

