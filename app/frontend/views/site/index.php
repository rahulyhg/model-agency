<?php
/**
 * @var $this \yii\web\View
 */

use yii\helpers\Url;
?>
<section class="b-section b-main__item">
  <header class="b-section__header">
    <h1 class="b-title b-section__header-title"><span class="b-title__texts b-title__texts_line-first"><span
            class="b-title__text-first">Elite model</span><span
            class="b-title__text-second">agency</span></span></h1>
  </header>
  <div class="b-section__main">
    <div class="b-section__texts">
      <p class="b-text b-section__text">Project description... Lorem ipsum dolor sit amet, consectetur
        adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et
        viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis
        parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis
        tellus mollis orci, sed rhoncus sapien nunc eget.</p>
      <p class="b-text b-section__text">Project description... Lorem ipsum dolor sit amet, consectetur
        adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et
        viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis
        parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis
        tellus mollis orci, sed rhoncus sapien nunc eget.</p>
    </div>
  </div>
</section>
<div class="b-combine-two-sections b-main__item b-main__item_stick-top">
  <div class="b-combine-two-sections__items">
    <div class="b-call-to-action b-combine-two-sections__item">
      <div class="b-call-to-action__inner"
           style="background-image: url(&quot;<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/call-to-actions/1.jpg&quot;">
        <div class="b-call-to-action__static">
          <h2 class="b-call-to-action__title">I am a model</h2>
        </div>
        <div class="b-call-to-action__absolute">
          <h3 class="b-call-to-action__subtitle">And I want to become popular</h3><a
              class="b-button b-button_first b-call-to-action__button" href="<?= Url::to(['/mod/signup/model']) ?>"><span
                class="b-button__texts b-button__texts_uppercase"><span class="b-button__text-second">Register as a</span><span
                  class="b-button__text-first">model</span></span></a>
        </div>
      </div>
    </div>
    <div class="b-call-to-action b-combine-two-sections__item">
      <div class="b-call-to-action__inner"
           style="background-image: url(&quot;<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/call-to-actions/2.jpg&quot;">
        <div class="b-call-to-action__static">
          <h2 class="b-call-to-action__title">I am a manager</h2>
        </div>
        <div class="b-call-to-action__absolute">
          <h3 class="b-call-to-action__subtitle">And I need a company face</h3><a
              class="b-button b-button_second b-call-to-action__button" href="<?= Url::to(['/mod/signup/manager']) ?>"><span
                class="b-button__texts b-button__texts_uppercase"><span class="b-button__text-second">Register as a</span><span
                  class="b-button__text-first">User</span></span></a>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="b-section b-main__item">
  <header class="b-section__header">
    <h1 class="b-title b-section__header-title"><span class="b-title__texts b-title__texts_line-first"><span
            class="b-title__text-first">Top rated</span><span
            class="b-title__text-second">models</span></span></h1>
  </header>
  <div class="b-our-models b-section__main">
    <div class="b-our-models__items"><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/1.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/2.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/3.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/1.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/2.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/3.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/1.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/2.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a><a class="b-our-model b-our-models__item" href="single-model.html">
        <div class="b-our-model__box"><img class="b-our-model__img" alt="julia bogdanova"
                                           src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/our-models/3.jpg">
          <h2 class="b-our-model__name">Julia Bogdanova</h2>
        </div>
        <div class="b-like b-our-model__footer">
          <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
            <div class="b-like__value">1447</div>
          </div>
        </div>
      </a></div>
  </div>
</section>
