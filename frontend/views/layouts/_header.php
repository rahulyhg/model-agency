<?php
/**
 * @var $this \yii\web\View
 */

use frontend\widgets\Breadcrumbs;

if (isset($this->params['showSearchForm'])) {
  $this->registerJs('
        $(document).ready(function () {
            $(\'#search-location\').select2({
                "searchInputPlaceholder": \'Введите название населенного пункта\',
                "language": {
                    "noResults": function () {
                        return "Ничего не найдено";
                    }
                }
            });
        
            $(\'select\').on(\'select2:open\', function (e) {
                $(\'.select2-results__options\').scrollbar().parent().addClass(\'scrollbar-outer\');
                $(\'.select2-search input\').prop(\'focus\', false);
            });
        
            $(\'[data-select2-non-search]\').select2({
                "minimumResultsForSearch": -1
            });

            $(\'[data-select2-filter]\').select2({
                "minimumResultsForSearch": -1,
                allowClear: true,
                placeholder: ""
            });
            
            $(\'[data-select2-search]\').select2();
        
            $(\'.b-form-group__items\').scrollbar();
        });
    ');
}
if (isset($this->params['showCategories'])) {
  $this->registerJs('
        $(document).ready(function() {
            new ShowSubcategories({
                \'category\': \'.b-category\',
                \'categoryModificator\': \'b-category_view-subcategory\',
                \'categoryLink\': \'.b-category__link\',
                \'categorySubcategories\': \'.b-category__subcategories\',
                \'subcategoriesArrow\': \'.b-subcategories__arrow\',
                \'blackoutPage\': \'.b-blackout-page\',
                \'blackoutPageModificator\': \'b-blackout-page_show\'
            })
        })
    ');
}
?>
<header class="b-header b-page__header">
  <div class="b-header__first">
    <div class="b-header__first-inner">
      <div class="b-header__first-row">
        <div class="b-header__first-left">
          <a class="b-logo b-header__logo" href="<?= \yii\helpers\Url::to(['/']) ?>">
            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/logo.png" alt="ADV Board" class="b-logo__img">
          </a>
        </div>

        <?= \modules\lang\widgets\frontendLangSwitcher\LangSwitcher::widget([
          'elementClass' => 'b-header__multilanguage'
        ]) ?>

        <div class="b-header__first-right">
          <div class="b-user b-header__user">
            <?php if( Yii::$app->user->isGuest ) : ?>
              <a href="<?= \yii\helpers\Url::to(['/client/default/login']) ?>"><?= Yii::t('header', 'Войти') ?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?= \yii\helpers\Url::to(['/client/default/signup']) ?>"><?= Yii::t('header', 'Зарегистрироваться') ?></a>
            <?php else : ?>
            <div class="b-user__name"><?= Yii::$app->user->identity->name ?></div>

            <span class="b-user__drop-arrow">
                                    <i class="b-user__drop-arrow-up pe-7s-angle-up"></i>
                                    <i class="b-user__drop-arrow-down pe-7s-angle-down"></i>
                                </span>

            <ul class="b-drop-list b-user__drop-list">
              <li class="b-drop-list__item">
                <a href="<?= \yii\helpers\Url::to(['/client/profile/index']) ?>#myProfile" class="b-drop-list__item-link"><?= Yii::t('header', 'Мой профиль') ?></a>
              </li>

              <li class="b-drop-list__item">
                <a href="<?= \yii\helpers\Url::to(['/client/profile/index']) ?>#myAds" class="b-drop-list__item-link"><?= Yii::t('header', 'Мои обьявления') ?></a>
              </li>

              <li class="b-drop-list__item">
                <a href="<?= \yii\helpers\Url::to(['/client/profile/index']) ?>#myPay" class="b-drop-list__item-link"><?= Yii::t('header', 'Мои платежи') ?></a>
              </li>

              <li class="b-drop-list__item">
                <a href="<?= \yii\helpers\Url::to(['/client/default/logout']) ?>" class="b-drop-list__item-link"><?= Yii::t('header', 'Выйти') ?></a>
              </li>
            </ul>
            <?php endif; ?>
          </div>

          <a href="<?= \yii\helpers\Url::to(['/bulletin/create/step1']) ?>" class="b-button-first b-header__button-first">
                                <span class="b-button-first__icon-wrp">
                                    <i class="b-button-first__icon pe-7s-plus"></i>
                                </span>

            <span class="b-button-first__value"><?= Yii::t('header', 'Подать обьявление') ?></span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php if (isset($this->params['showSearchForm']) || isset($this->params['showCategories']) || isset($this->params['breadcrumbs'])) : ?>
    <div class="b-header__second">
      <div class="b-header__second-inner">
        <?php if ($this->params['showSearchForm']) : ?>
          <?= \modules\bulletin\widgets\search\Search::widget([
              'elementClass' => 'b-header__search'
          ]) ?>
        <?php endif; ?>
        <?php if (isset($this->params['breadcrumbs'])) : ?>
          <div class="b-bread-crumbs b-header__bread-crumbs">
            <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
          </div>
        <?php endif; ?>
        <?php if ($this->params['showCategories']) : ?>
          <?= \modules\bulletin\widgets\categories\Categories::widget([
              'elementClass' => 'b-header__categories'
          ]) ?>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($this->params['filterForm']) : ?>
    <div class="b-header__third">
      <div class="b-header__third-inner">
        <?= $this->params['filterForm'] ?>
      </div>
    </div>
  <?php endif; ?>
</header>