<?php
/**
 * @var $this \yii\web\View
 * @var $model \modules\mod\common\models\Mod
 */

$this->title = $model->full_name;

$this->registerJs(
  <<<JS
  $(document).ready(function() {
      $('.b-single-model__slider-items').slick({
          fade: true,
          infinite: true,
          speed: 200,
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          dotsClass: 'b-single-model__slider-dots',
          prevArrow: $('.b-single-model__slider-arrow-prev'),
          nextArrow: $('.b-single-model__slider-arrow-next')
      });
  
  });
JS
);
$this->registerJs(
  <<<JS
  $(document).ready(e => {
    new ActiveInHover({
        items: '.b-menu__items',
        item: '.b-menu__item',
        activeClass: 'b-menu__item_active'
    })
    
    new ToggleTrigger({
        items: '.b-toggle__items',
        item: '.b-toggle__item',
        activeClass: 'b-toggle__item_active'
    }, () => {
        $('.b-main').toggleClass('b-main_sm-scroll-lock')
        $('.b-main').toggleClass('b-main_sm-transparent')
        $('.b-content').toggleClass('b-content_sm-blackout')
        $('.b-page__sidebar').toggleClass('b-page__sidebar_sm-open')
        $('.b-page__content').toggleClass('b-page__content_sm-shift')                
    })
    
    new AnimFeatures({
        parrent: '.b-features__items',
        itemTitle: '.b-features__title',
        lineTitle: '.b-features__title-line',
        itemValue: '.b-features__value',
        breakPoints: [1500, 1300, 1100, 960, 780, 560]
    })
  }) 
JS
);
?>
<section class="b-section b-main__item">
  <header class="b-section__header">
    <h1 class="b-title b-section__header-title"><span class="b-title__texts b-title__texts_line-first"><span class="b-title__text-first">Julia</span><span class="b-title__text-second">Bogdanova</span></span></h1>
    <button class="b-button b-button_first b-section__header-contacts-model-btn"><span class="b-button__texts"><span class="b-button__text-first">Contacts Model</span></span></button>
  </header>
  <div class="b-single-model b-section__main">
    <div class="b-single-model__inner">
      <div class="b-single-model__slider">
        <div class="b-single-model__slider-items">
          <?php
          if($model->modImages):
          foreach ($model->modImages as $image) : ?>
            <div class="b-single-model__slider-item">
              <a class="b-single-model__img-box" href="<?= $image->url ?>" style="background-image: url('<?= $image->url ?>')" data-fancybox="gallery">
                <img class="b-single-model__img" alt="julia bogdanova" src="<?= $image->url ?>">
              </a>
              <div class="b-single-model__footer">
                <div class="b-like b-single-model__like"><i class="b-like__icon fas fa-heart"></i>
                  <div class="b-like__value">1448</div>
                </div>
              </div>
            </div>
          <?php endforeach;
          else: ?>
            <div class="b-single-model__slider-item">
              <a class="b-single-model__img-box" href="<?= $model->modUser->photoUrl ?>" style="background-image: url('<?= $model->modUser->photoUrl ?>')" data-fancybox="gallery">
                <img class="b-single-model__img" alt="<?= $model->full_name ?>" src="<?= $model->modUser->photoUrl ?>">
              </a>
              <div class="b-single-model__footer">
                <div class="b-like b-single-model__like"><i class="b-like__icon fas fa-heart"></i>
                  <div class="b-like__value">1448</div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <div class="b-single-model__slider-arrows">
          <div class="b-single-model__slider-arrow-prev"><i class="b-single-model__slider-arrow-icon fas fa-chevron-left"></i></div>
          <div class="b-single-model__slider-arrow-next"><i class="b-single-model__slider-arrow-icon fas fa-chevron-right"></i></div>
        </div>
      </div>
      <?= $this->render('_properties', [
        'model' => $model,
        'elementClass' => 'b-single-model__features'
      ]) ?>
    </div>
  </div>
</section>
<section class="b-section b-main__item">
  <div class="b-pagination-model b-section__main">
    <div class="b-pagination-model__items"><a class="b-pagination-model__item" href="single-model.html">
        <div class="b-pagination-model__item-icon fas fa-arrow-left"></div>
        <div class="b-pagination-model__item-text">Julia Bogdanova</div></a>
      <div class="b-pagination-model__item">
        <div class="b-pagination-model__item-line"></div>
        <div class="b-pagination-model__item-text">Julia Bogdanova</div>
      </div><a class="b-pagination-model__item" href="single-model.html">
        <div class="b-pagination-model__item-text">Julia Bogdanova</div>
        <div class="b-pagination-model__item-icon fas fa-arrow-right"></div></a>
    </div>
  </div>
</section>
