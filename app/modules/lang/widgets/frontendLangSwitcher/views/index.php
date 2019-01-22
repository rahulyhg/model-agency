<?php
/**
 * @var $this \yii\web\View
 * @var $langs \modules\lang\common\models\Lang[]
 * @var $elementClass string
 */
?>
<div class="b-multilanguage <?= $elementClass ?>">
  <?php foreach ($langs as $lang) : ?>
    <?php if ($lang->is_default) : ?>
      <a class="b-multilanguage__item <?= \modules\lang\common\models\Lang::getCurrent()->ietf_tag === $lang->ietf_tag ? 'b-multilanguage__item_active' : '' ?>"
         href="<?= Yii::$app->getRequest()->getLangUrl() ?>">
        <?= $lang->label ?>
      </a>
    <?php else : ?>
      <a class="b-multilanguage__item <?= \modules\lang\common\models\Lang::getCurrent()->ietf_tag === $lang->ietf_tag ? 'b-multilanguage__item_active' : '' ?>"
         href="<?= '/' . $lang->ietf_tag . Yii::$app->getRequest()->getLangUrl() ?>">
        <?= $lang->label ?>
      </a>
    <?php endif; ?>
  <?php endforeach; ?>
</div>

