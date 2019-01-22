<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use \yii\helpers\Url;

AppAsset::register($this);
Yii::$app->theme->registerThemeAsset($this);
$this->registerJs("
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
})
");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/favicon.ico" type="image/x-icon"/>
  <title><?= Html::encode($this->title) ?></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"/>
  <?php if(isset($this->params['meta_description'])) : ?>
  <meta name="description" content="<?= $this->params['meta_description'] ?>">
  <?php endif; ?>
  <?= Html::csrfMetaTags() ?>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="b-page">
  <?= $this->render('_sidebar') ?>
  <div class="b-content b-page__content">
    <?= $this->render('_header') ?>
    <main class="b-main b-content__main">
      <?= $this->render('_nav-line') ?>
      <div class="b-main__inner">
        <div class="b-main__items">
          <?= \common\widgets\Alert::widget([
            'options' => [
              'class' => 'b-main__alert'
            ],
            'closeButton' => ['label' => Yii::t('common', 'закрыть')],
          ]) ?>
          <?= $content ?>
        </div>
      </div>
    </main>
  </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
