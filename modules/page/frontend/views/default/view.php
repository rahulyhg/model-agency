<?php
/**
 * @var $model modules\page\common\models\Page
 */
use yii\helpers\Url;

?>
<div class="b-news-post b-page__news-post">
  <div class="b-news-post__wrapper">
    <div class="b-news-post__header" >
      <div class="b-news-post__header-title"><?= $model->title ?></div>
    </div>
    <?= Yii::$app->block->page_before_content ?>
    <div class="b-news-post__content"><?= $model->content ?></div>
    <?= Yii::$app->block->page_after_content ?>
  </div>
</div>