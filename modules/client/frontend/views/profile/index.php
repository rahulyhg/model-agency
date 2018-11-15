<?php
/**
 * @var $this \yii\web\View
 * @var $client \modules\client\common\models\Client
 * @var $activeBulletins \modules\bulletin\common\models\Bulletin[]
 * @var $notActiveBulletins \modules\bulletin\common\models\Bulletin[]
 */

use modules\client\Module;

$this->registerJs('
$(document).ready(function() {
    new Tabs({
      toggleTabs: \'.b-profile__toggle-tab-link\',
      classActiveTab: \'b-profile__toggle-tab-link_active\',
      bodyTabs: \'.b-profile__body-tab\'
    })
    new Tabs({
      toggleTabs: \'.b-my-ads__toggle-tab-link\',
      classActiveTab: \'b-my-ads__toggle-tab-link_active\',
      bodyTabs: \'.b-my-ads__body-tab\'
    })
  })
  
  $(document).ready(function () {
      $(\'[data-select2-non-search]\').select2({
          "minimumResultsForSearch": -1
      });

      $(\'[data-select2-search]\').select2();

      $(\'select\').on(\'select2:open\', function (e) {
          $(\'.select2-results__options\').scrollbar().parent().addClass(\'scrollbar-outer\');
          $(\'.select2-search input\').prop(\'focus\', false);
      });

      $("#phone").mask("+38 (099) 999-9999");
  });
');
?>
<!-- b-content -->
<div class="b-content b-main__content">

  <section class="b-profile b-content__profile">
    <header class="b-profile__header">
      <ul class="b-profile__toggle-tabs">
        <li class="b-profile__toggle-tab">
          <a class="b-profile__toggle-tab-link" href="#myProfile"><?= Module::t('profile', 'Мой профиль') ?></a>
        </li>

        <li class="b-profile__toggle-tab">
          <a class="b-profile__toggle-tab-link" href="#myAds"><?= Module::t('profile', 'Мои объявления') ?></a>
        </li>

        <li class="b-profile__toggle-tab">
          <a class="b-profile__toggle-tab-link" href="#myPay"><?= Module::t('profile', 'Мои платежи') ?></a>
        </li>
      </ul>
    </header>

    <main class="b-profile__main">
      <ul class="b-profile__body-tabs">
        <li id="myProfile" class="b-profile__body-tab">
          <?= $this->render('_client-form', [
            'elementClass' => 'b-profile__my-profile',
            'model' => $client
          ]) ?>
        </li>

        <li id="myAds" class="b-profile__body-tab">
          <?= $this->render('_client-ads', [
            'elementClass' => 'b-profile__my-ads',
            'activeBulletins' => $activeBulletins,
            'notActiveBulletins' => $notActiveBulletins
          ]) ?>
        </li>

        <li id="myPay" class="b-profile__body-tab">
          <?= $this->render('_client-payment', [
            'elementClass' => 'b-profile__my-pay'
          ]) ?>
        </li>
      </ul>
    </main>
  </section>

</div>
<!-- b-content end -->