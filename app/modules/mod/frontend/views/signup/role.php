<?php
/**
 * @var $this \yii\web\View
 */
use yii\helpers\Url;
$this->title = "Регистрация в модельной агентстве - выбор роли";
?>
<section class="b-section b-main__item">
  <header class="b-section__header">
    <h1 class="b-title b-section__header-title"><span class="b-title__texts b-title__texts_line-first"><span
          class="b-title__text-first">Выберите</span><span
          class="b-title__text-second">роль</span></span></h1>
  </header>
</section>
<div class="b-combine-two-sections b-main__item b-main__item_stick-top">
  <div class="b-combine-two-sections__items">
    <div class="b-call-to-action b-combine-two-sections__item">
      <div class="b-call-to-action__inner"
           style="background-image: url(&quot;<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/call-to-actions/1.jpg&quot;">
        <div class="b-call-to-action__static">
          <h2 class="b-call-to-action__title">Я модель</h2>
        </div>
        <div class="b-call-to-action__absolute">
          <h3 class="b-call-to-action__subtitle">И я хочу стать популярной</h3><a
            class="b-button b-button_first b-call-to-action__button" href="<?= Url::to(['/mod/signup/model']) ?>"><span
              class="b-button__texts b-button__texts_uppercase"><span class="b-button__text-second">Зарегистрироваться </span><span
                class="b-button__text-first">как модель</span></span></a>
        </div>
      </div>
    </div>
    <div class="b-call-to-action b-combine-two-sections__item">
      <div class="b-call-to-action__inner"
           style="background-image: url(&quot;<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/call-to-actions/2.jpg&quot;">
        <div class="b-call-to-action__static">
          <h2 class="b-call-to-action__title">Я менеджер</h2>
        </div>
        <div class="b-call-to-action__absolute">
          <h3 class="b-call-to-action__subtitle">И мне нужно лицо компании</h3><a
            class="b-button b-button_second b-call-to-action__button" href="<?= Url::to(['/mod/signup/manager']) ?>"><span
              class="b-button__texts b-button__texts_uppercase"><span class="b-button__text-second">Зарегистрироваться</span><span
                class="b-button__text-first">как менеджер</span></span></a>
        </div>
      </div>
    </div>
  </div>
</div>