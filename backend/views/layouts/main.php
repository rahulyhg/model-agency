<?php

/* @var $this \backend\lib\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
Yii::$app->metronic->registerThemeAsset($this);
$this->registerJs('WebFont.load({
  google: {"families":["Roboto:300,400,500,600,700","Roboto:300,400,500,600,700"]},
  active: function() {
      sessionStorage.fonts = true;
  }
});', \yii\web\View::POS_LOAD);
$this->registerCss('.popover.fade:not(.show){
opacity: 1;
}
.select2-container .select2-selection--single .select2-selection__clear {
    position: absolute;
	 right: 25px;
}
.doc_dynamicform_wrapper .file-preview-frame {
  width: 97%;
}
')
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<body
  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
  <!-- BEGIN: Header -->
  <header id="m_header" class="m-grid__item m-header " minimize-offset="200" minimize-mobile-offset="200"
          style="z-index: 999">
    <div class="m-container m-container--fluid m-container--full-height">
      <div class="m-stack m-stack--ver m-stack--desktop">
        <!-- BEGIN: Brand -->
        <div class="m-stack__item m-brand  m-brand--skin-dark ">
          <div class="m-stack m-stack--ver m-stack--general">
            <div class="m-stack__item m-stack__item--middle m-stack__item--center m-brand__logo">
              <a href="<?= Url::home() ?>" class="m-brand__logo-wrapper">
                <img alt="" src="<?= Yii::$app->metronic->getAssetsUrl($this) ?>/demo/default/media/img/logo/logo.png">
              </a>
            </div>
            <div class="m-stack__item m-stack__item--middle m-brand__tools">
              <!-- BEGIN: Responsive Aside Left Menu Toggler -->
              <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                 class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                <span></span>
              </a>
              <!-- END -->
              <!-- BEGIN: Responsive Header Menu Toggler -->
              <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                 class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                <span></span>
              </a>
              <!-- END -->
              <!-- BEGIN: Topbar Toggler -->
              <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                 class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                <i class="flaticon-more"></i>
              </a>
              <!-- BEGIN: Topbar Toggler -->
            </div>
          </div>
        </div>
        <!-- END: Brand -->
        <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
          <!-- BEGIN: Horizontal Menu -->
          <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                  id="m_aside_header_menu_mobile_close_btn">
            <i class="la la-close"></i>
          </button>
          <div id="m_header_menu"
               class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
              <li class="m-menu__item">
                <a class="m-menu__link" href="<?= Url::to(['/user/create']) ?>"><i
                    class="m-menu__link-icon flaticon-add"></i><span class="m-menu__link-text">Пользователь</span></a>
              </li>
            </ul>
          </div>
          <!-- BEGIN: Topbar -->
          <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
            <div class="m-stack__item m-topbar__nav-wrapper">
              <ul class="m-topbar__nav m-nav m-nav--inline">

                <li
                  class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                  m-dropdown-toggle="click">
                  <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img
                            src="<?= Yii::$app->user->identity->photoUrl ?: Yii::$app->metronic->getAssetsUrl($this) . '/app/media/img/users/user4.jpg' ?>"
                            alt="">
												</span>
                  </a>

                  <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>

                    <div class="m-dropdown__inner">
                      <div class="m-dropdown__header m--align-center"
                           style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                        <div class="m-card-user m-card-user--skin-dark">
                          <div class="m-card-user__pic">
                            <img src="<?= Yii::$app->user->identity->photoUrl ?>"
                                 alt="">
                          </div>
                          <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	<?= Yii::$app->user->identity->username ?>
																</span>
                            <a href="" class="m-card-user__email m--font-weight-300 m-link">
                              <?= Yii::$app->user->identity->email ?>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="m-dropdown__body">
                        <div class="m-dropdown__content">
                          <ul class="m-nav m-nav--skin-light">
                            <li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
                            </li>
                            <li class="m-nav__item">
                              <a href="<?= Url::to(['/user/update', 'id' => Yii::$app->user->identity->id]) ?>"
                                 class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					My Profile
																				</span>
																			</span>
																		</span>
                              </a>
                            </li>
                            <li class="m-nav__separator m-nav__separator--fit"></li>
                            <li class="m-nav__item">
                              <?=
                              Html::beginForm(['/site/logout'], 'post')
                              . Html::submitButton('Logout ', ['class' => 'btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder'])
                              . Html::endForm()
                              ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <!-- END: Topbar -->
        </div>
      </div>
    </div>
  </header>
  <!-- END: Header -->
  <!-- begin::Body -->
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
    <!-- BEGIN: Left Aside -->
    <button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn">
      <i class="la la-close"></i>
    </button>
    <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
      <!-- BEGIN: Aside Menu -->
      <?= backend\widgets\Menu::widget([
        'items' => [
          ['label' => 'Консоль', 'icon' => 'flaticon-line-graph', 'url' => ['/site']],
          ['label' => 'Настройки', 'icon' => 'flaticon-settings', 'url' => ['/setting']],
          ['label' => 'Страницы', 'icon' => 'flaticon-file', 'url' => ['/page']],
          ['label' => 'Баннеры', 'icon' => 'flaticon-book', 'url' => ['/banner']],
          ['label' => 'Блоки', 'icon' => 'flaticon-squares-4', 'url' => ['/block']],
          ['label' => 'Пользователи', 'icon' => 'flaticon-user', 'url' => ['/user']],
          ['label' => 'Файловый менеджер', 'icon' => 'flaticon-folder-1', 'url' => ['/file-manager']],
          ['label' => 'Языки', 'icon' => 'fa fa-globe', 'url' => ['/lang'], 'itemsIcon' => 'line', 'items' => [
            ['label' => 'Новый', 'url' => ['/lang/create']],
            ['label' => 'Русский', 'url' => ['/lang/update', 'id' => '1']],
            ['label' => 'Украинский', 'url' => ['/lang/update', 'id' => '2']],
          ]],
        ],
      ]) ?>
      <!-- END: Aside Menu -->
    </div>
    <!-- END: Left Aside -->
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator"><?= $this->title ?></h3>
            <?= backend\widgets\Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
          </div>
        </div>
      </div>
      <!-- END: Subheader -->
      <div class="m-content">
        <?= \common\widgets\Alert::widget([
          'options' => [
            'class' => 'show alert-dismissible'
          ],
          'closeButton' => ['label' => ''],
        ]) ?>
        <?= $content ?>
      </div>
    </div>
  </div>
  <!-- end:: Body -->
</div>
<!-- end:: Page -->
<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
  <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<!-- end::Body -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
