<?php
/**
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\helpers\Url;
?>
<section class="b-section b-main__item">
  <header class="b-section__header">
    <h1 class="b-title b-section__header-title"><span class="b-title__texts b-title__texts_line-first"><span class="b-title__text-first">Our</span><span class="b-title__text-second">models</span></span></h1>
    <form class="b-search b-section__header-search" action="search-model">
      <label class="b-field b-search__field">
        <input class="b-field__input b-field__input_icon b-field__input_icon-xs-none b-field__input_search" type="text" name="name-model" placeholder="Enter model name"><i class="b-field__icon b-field__icon_xs-none b-field__icon_first fas fa-search"></i>
      </label>
      <button class="b-button b-button_first b-button_search b-search__button" type="submit"><span class="b-button__texts"><span class="b-button__text-first">Search</span><i class="b-button__icon fas fa-search"></i></span></button>
    </form>
  </header>
  <div class="b-our-models b-section__main">
    <div class="b-our-models__items">
      <?php foreach ($dataProvider->models as $model) :
      /**
       * @var $model \modules\mod\common\models\Mod
       */
      ?>
        <a class="b-our-model b-our-models__item" href="<?= Url::to(['/mod/model/view', 'id' => 1]) ?>">
          <div class="b-our-model__box">
            <img class="b-our-model__img"
                 alt="<?= "{$model->first_name} {$model->last_name}" ?>"
                 src="<?= $model->modUser->photoUrl ?: Yii::$app->theme->getAssetsUrl($this) . '/img/default-model-photo.jpg' ?>">
            <h2 class="b-our-model__name"><?= "{$model->first_name} {$model->last_name}" ?></h2>
          </div>
          <div class="b-our-model__footer">
            <div class="b-like b-our-model__like"><i class="b-like__icon fas fa-heart"></i>
              <div class="b-like__value">1447</div>
            </div>
          </div>
        </a>
      <?php  endforeach; ?>
    </div>
  </div>
</section>
