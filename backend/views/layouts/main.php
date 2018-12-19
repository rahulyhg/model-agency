<?php

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
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <!-- begin::Head -->
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
              sessionStorage.fonts = true;
            }
          });
        </script>
        <!--end::Web font -->
      <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
      <?php $this->head() ?>
    </head>
    <body
            class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <?php $this->beginBody() ?>
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

        <!-- BEGIN: Header -->
        <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
            <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop">

                    <!-- BEGIN: Brand -->
                    <div class="m-stack__item m-brand  m-brand--skin-dark ">
                        <div class="m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="<?= Url::to(['/']) ?>" class="m-brand__logo-wrapper">
                                    <img alt=""
                                         src="<?= Yii::$app->metronic->getAssetsUrl($this) ?>/demo/default/media/img/logo/logo_default_dark.png"/>
                                </a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">

                                <!-- BEGIN: Left Aside Minimize Toggle -->
                                <a href="javascript:;" id="m_aside_left_minimize_toggle"
                                   class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                                    <span></span>
                                </a>

                                <!-- END -->

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
                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark"
                                id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <!-- END: Horizontal Menu -->

                        <!-- BEGIN: Topbar -->
                        <div id="m_header_topbar"
                             class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        m-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="<?= Yii::$app->user->identity->photoUrl ?: Yii::$app->metronic->getAssetsUrl($this) . '/app/media/img/users/user4.jpg' ?>"
                                                         alt="">
												</span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__header m--align-center"
                                                     style="background: url('<?= Yii::$app->metronic->getAssetsUrl($this) ?>app/media/img/misc/user_profile_bg.jpg'); background-size: cover;">
                                                    <div class="m-card-user m-card-user--skin-dark">
                                                        <div class="m-card-user__pic">
                                                            <img src="<?= Yii::$app->user->identity->photoUrl ?>"
                                                                 alt="">
                                                        </div>
                                                        <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	<?= Yii::$app->user->identity->username ?>
																</span>
                                                            <a href=""
                                                               class="m-card-user__email m--font-weight-300 m-link">
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
                                                                <a href="<?= Url::to(['/user/default/update', 'id' => Yii::$app->user->identity->id]) ?>"
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
            <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
                        class="la la-close"></i></button>
            <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

                <!-- BEGIN: Aside Menu -->
                <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                     m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500"
                     style="position: relative;">
                    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="<?= Url::to(['/']) ?>" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-text">Консоль</span>
                            </a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover"><a
                                    href="javascript:;" class="m-menu__link m-menu__toggle"><i
                                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">Модели</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>

                            <div class="m-menu__submenu " style="display: none; overflow: hidden;"
                                 m-hidden-height="840"><span
                                        class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true"><a
                                                href="<?= Url::to(['/mod']) ?>"
                                                class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">Модели</span></a></li>
                                    <li class="m-menu__item " aria-haspopup="true"><a
                                                href="<?= Url::to(['/mod/hair-color/index']) ?>"
                                                class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">Цвет волос</span></a></li>
                                    <li class="m-menu__item " aria-haspopup="true"><a
                                                href="<?= Url::to(['/mod/eyes-color/index']) ?>"
                                                class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">Цвет глаз</span></a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="<?= Url::to(['/setting']) ?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-settings"></i>
                                <span class="m-menu__link-text">Настройки</span>
                            </a>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="<?= Url::to(['/page']) ?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-file"></i>
                                <span class="m-menu__link-text">Страницы</span>
                            </a>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="<?= Url::to(['/banner']) ?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-book"></i>
                                <span class="m-menu__link-text">Баннеры</span>
                            </a>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="<?= Url::to(['/block']) ?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-squares-4"></i>
                                <span class="m-menu__link-text">Блоки</span>
                            </a>
                        </li>
                        <!--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="<?/*= Url::to(['/client']) */?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-user"></i>
                                <span class="m-menu__link-text">Клиенты</span>
                            </a>
                        </li>-->
                        <!--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="<?/*= Url::to(['/user']) */?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-user"></i>
                                <span class="m-menu__link-text">Пользователи</span>
                            </a>
                        </li>-->
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="<?= Url::to(['/file-manager']) ?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-folder-1"></i>
                                <span class="m-menu__link-text">Файловый менеджер</span>
                            </a>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="<?= Url::to(['/lang']) ?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon fa fa-globe"></i>
                                <span class="m-menu__link-text">Языки</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- END: Aside Menu -->
            </div>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid">

                <!-- BEGIN: Subheader -->
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title m-subheader__title--separator"><?= $this->title ?></h3>
                          <?= backend\widgets\Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                          ]) ?>
                        </div>
                      <?php if (isset($this->params['actions'])) : ?>
                          <div>
                            <?php foreach ($this->params['actions'] as $action) : ?>
                                <a href="<?= $action['url'] ?>"
                                   class="btn btn-<?= $action['type'] ?: 'default' ?> m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                <span>
                                    <i class="<?= $action['icon'] ?>"></i>
                                    <span><?= $action['label'] ?></span>
                                </span>
                                </a>
                            <?php endforeach; ?>
                          </div>
                      <?php endif; ?>
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
                    <div class="m-portlet">
                      <?= $content ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Body -->
    </div>

    <!-- end:: Page -->

    <!-- begin::Quick Sidebar -->
    <div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
        <div class="m-quick-sidebar__content m--hide">
            <span id="m_quick_sidebar_close" class="m-quick-sidebar__close"><i class="la la-close"></i></span>
            <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger"
                       role="tab">Messages</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_settings"
                       role="tab">Settings</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs"
                       role="tab">Logs</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
                    <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                        <div class="m-messenger__messages m-scrollable">
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--in">
                                    <div class="m-messenger__message-pic">
                                        <img src="../../assets/app/media/img//users/user3.jpg" alt=""/>
                                    </div>
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-username">
                                                Megan wrote
                                            </div>
                                            <div class="m-messenger__message-text">
                                                Hi Bob. What time will be the meeting ?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--out">
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-text">
                                                Hi Megan. It's at 2.30PM
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--in">
                                    <div class="m-messenger__message-pic">
                                        <img src="../../assets/app/media/img//users/user3.jpg" alt=""/>
                                    </div>
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-username">
                                                Megan wrote
                                            </div>
                                            <div class="m-messenger__message-text">
                                                Will the development team be joining ?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--out">
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-text">
                                                Yes sure. I invited them as well
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__datetime">2:30PM</div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--in">
                                    <div class="m-messenger__message-pic">
                                        <img src="../../assets/app/media/img//users/user3.jpg" alt=""/>
                                    </div>
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-username">
                                                Megan wrote
                                            </div>
                                            <div class="m-messenger__message-text">
                                                Noted. For the Coca-Cola Mobile App project as well ?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--out">
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-text">
                                                Yes, sure.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--out">
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-text">
                                                Please also prepare the quotation for the Loop CRM project as well.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__datetime">3:15PM</div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--in">
                                    <div class="m-messenger__message-no-pic m--bg-fill-danger">
                                        <span>M</span>
                                    </div>
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-username">
                                                Megan wrote
                                            </div>
                                            <div class="m-messenger__message-text">
                                                Noted. I will prepare it.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--out">
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-text">
                                                Thanks Megan. I will see you later.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__wrapper">
                                <div class="m-messenger__message m-messenger__message--in">
                                    <div class="m-messenger__message-pic">
                                        <img src="../../assets/app/media/img//users/user3.jpg" alt=""/>
                                    </div>
                                    <div class="m-messenger__message-body">
                                        <div class="m-messenger__message-arrow"></div>
                                        <div class="m-messenger__message-content">
                                            <div class="m-messenger__message-username">
                                                Megan wrote
                                            </div>
                                            <div class="m-messenger__message-text">
                                                Sure. See you in the meeting soon.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-messenger__seperator"></div>
                        <div class="m-messenger__form">
                            <div class="m-messenger__form-controls">
                                <input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
                            </div>
                            <div class="m-messenger__form-tools">
                                <a href="" class="m-messenger__form-attachment">
                                    <i class="la la-paperclip"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="m_quick_sidebar_tabs_settings" role="tabpanel">
                    <div class="m-list-settings m-scrollable">
                        <div class="m-list-settings__group">
                            <div class="m-list-settings__heading">General Settings</div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">Email Notifications</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" checked="checked" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">Site Tracking</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">SMS Alerts</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">Backup Storage</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">Audit Logs</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" checked="checked" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                        </div>
                        <div class="m-list-settings__group">
                            <div class="m-list-settings__heading">System Settings</div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">System Logs</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">Error Reporting</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">Applications Logs</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">Backup Servers</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" checked="checked" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                            <div class="m-list-settings__item">
                                <span class="m-list-settings__item-label">Audit Logs</span>
                                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
                        <input type="checkbox" name="">
                        <span></span>
                      </label>
										</span>
									</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="m_quick_sidebar_tabs_logs" role="tabpanel">
                    <div class="m-list-timeline m-scrollable">
                        <div class="m-list-timeline__group">
                            <div class="m-list-timeline__heading">
                                System Logs
                            </div>
                            <div class="m-list-timeline__items">
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">12 new users registered <span
                                                class="m-badge m-badge--warning m-badge--wide">important</span></a>
                                    <span class="m-list-timeline__time">Just now</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">System shutdown</a>
                                    <span class="m-list-timeline__time">11 mins</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                    <a href="" class="m-list-timeline__text">New invoice received</a>
                                    <span class="m-list-timeline__time">20 mins</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                    <a href="" class="m-list-timeline__text">Database overloaded 89% <span
                                                class="m-badge m-badge--success m-badge--wide">resolved</span></a>
                                    <span class="m-list-timeline__time">1 hr</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">System error</a>
                                    <span class="m-list-timeline__time">2 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">Production server down <span
                                                class="m-badge m-badge--danger m-badge--wide">pending</span></a>
                                    <span class="m-list-timeline__time">3 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">Production server up</a>
                                    <span class="m-list-timeline__time">5 hrs</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-list-timeline__group">
                            <div class="m-list-timeline__heading">
                                Applications Logs
                            </div>
                            <div class="m-list-timeline__items">
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">New order received <span
                                                class="m-badge m-badge--info m-badge--wide">urgent</span></a>
                                    <span class="m-list-timeline__time">7 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">12 new users registered</a>
                                    <span class="m-list-timeline__time">Just now</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">System shutdown</a>
                                    <span class="m-list-timeline__time">11 mins</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                    <a href="" class="m-list-timeline__text">New invoices received</a>
                                    <span class="m-list-timeline__time">20 mins</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                    <a href="" class="m-list-timeline__text">Database overloaded 89%</a>
                                    <span class="m-list-timeline__time">1 hr</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">System error <span
                                                class="m-badge m-badge--info m-badge--wide">pending</span></a>
                                    <span class="m-list-timeline__time">2 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">Production server down</a>
                                    <span class="m-list-timeline__time">3 hrs</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-list-timeline__group">
                            <div class="m-list-timeline__heading">
                                Server Logs
                            </div>
                            <div class="m-list-timeline__items">
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">Production server up</a>
                                    <span class="m-list-timeline__time">5 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">New order received</a>
                                    <span class="m-list-timeline__time">7 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">12 new users registered</a>
                                    <span class="m-list-timeline__time">Just now</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">System shutdown</a>
                                    <span class="m-list-timeline__time">11 mins</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                    <a href="" class="m-list-timeline__text">New invoice received</a>
                                    <span class="m-list-timeline__time">20 mins</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                    <a href="" class="m-list-timeline__text">Database overloaded 89%</a>
                                    <span class="m-list-timeline__time">1 hr</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">System error</a>
                                    <span class="m-list-timeline__time">2 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">Production server down</a>
                                    <span class="m-list-timeline__time">3 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                    <a href="" class="m-list-timeline__text">Production server up</a>
                                    <span class="m-list-timeline__time">5 hrs</span>
                                </div>
                                <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                    <a href="" class="m-list-timeline__text">New order received</a>
                                    <span class="m-list-timeline__time">1117 hrs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end::Quick Sidebar -->

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>