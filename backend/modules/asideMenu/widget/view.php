<?php
/**
 * @var $items \backend\modules\asideMenu\widget\MenuItem[]
 */
?>
<div id="m_ver_menu"
     class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown"
     data-menu-vertical="true" m-menu-dropdown="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <?php foreach($items as $item) : ?>
        <li class="m-menu__item">
            <a href="<?= $item->url ?>" class="m-menu__link ">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon <?= $item->icon ?>"></i>
                <span class="m-menu__link-text">
										<?= $item->name ?>
									</span>
            </a>
        </li>
        <?php endforeach; ?>
        <li class="m-menu__item">
            <a href="<?= yii\helpers\Url::to(['/']) ?>" class="m-menu__link ">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-text">
										Консоль
									</span>
            </a>
        </li>
        <li class="m-menu__item m-menu__item--bottom-2">
            <a href="<?= yii\helpers\Url::to(['/setting']) ?>" class="m-menu__link">
                <i class="m-menu__link-icon flaticon-settings"></i>
                <span class="m-menu__link-text">
                Настройки
              </span>
            </a>
        </li>
        <li class="m-menu__item">
            <a href="<?= yii\helpers\Url::to( [ '/page' ] ) ?>" class="m-menu__link">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-file"></i>
                <span class="m-menu__link-text">
										Pages
									</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
        </li>
        <li class="m-menu__item m-menu__item--bottom-2">
            <a href="<?= yii\helpers\Url::to( [ '/block' ] ) ?>" class="m-menu__link">
                <i class="m-menu__link-icon flaticon-squares-4"></i>
                <span class="m-menu__link-text">
										Blocks
									</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
        </li>
        <li class="m-menu__item m-menu__item--bottom-2">
            <a href="<?= yii\helpers\Url::to( [ '/user' ] ) ?>" class="m-menu__link">
                <i class="m-menu__link-icon flaticon-user"></i>
                <span class="m-menu__link-text">
                Users
              </span>
            </a>
        </li>
        <li class="m-menu__item">
            <a href="<?= yii\helpers\Url::to( [ '/file-manager' ] ) ?>" class="m-menu__link">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-folder-1"></i>
                <span class="m-menu__link-text">
                File Manager
              </span>
            </a>
        </li>
    </ul>
</div>
      