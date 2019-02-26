<?php
/**
 * @var $this \yii\web\View
 * @var $attributes array
 * @var $count int
 * @var $entityId int
 * @var $entity string
 */
use \yii\helpers\Html;

\modules\like\widgets\like\LikeAsset::register($this);

$attributes['class'] = 'b-like ' . $attributes['class'];

$url = \yii\helpers\Url::to(['/like/add']);
$this->registerJs(<<<JS
var LIKE_WIDGET_CONFIG = {
  url: "$url"
}
JS
, \yii\web\View::POS_HEAD)
?>
<div <?= Html::renderTagAttributes($attributes) ?> data-like-entity-id="<?= $entityId ?>" data-like-count="<?= $count ?>" data-like-entity="<?= $entity ?>">
  <i class="b-like__icon fas fa-heart"></i>
  <div class="b-like__value" data-like-source><?= $count ?></div>
</div>