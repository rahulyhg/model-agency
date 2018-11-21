<?php
/**
 * @var $this \yii\web\View
 */
use modules\bulletin\Module;
?>
<!-- b-content -->
<div class="b-content b-main__content">

  <!-- b-place-an-ad -->
  <section class="b-place-an-ad b-content__place-an-ad">
    <header class="b-place-an-ad__header">
      <h2 class="b-place-an-ad__title"><?= Module::t('adv-form', 'Спасибо за публикацию обьявления.') ?></h2>
      <h3 class="b-place-an-ad__subtitle"><?= Module::t('adv-form', 'Ваше объявление будет опубликовано сразу же после модерации!') ?></h3>

      <a href="<?= \yii\helpers\Url::to(['/']) ?>" class="b-button-second b-place-an-ad__back-home">
        <span class="b-button-second__value"><?= Module::t('adv-form', 'Вернуться на главную') ?></span>
      </a>
    </header>
  </section>
  <!-- b-place-an-ad -->

</div>
<!-- b-content end -->