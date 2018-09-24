<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.09.2018
 * Time: 10:56
 */

namespace backend\widgets;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Menu extends \yii\widgets\Menu
{
  public $activeCssClass = 'm-menu__item--active';

  public $linkTemplate = '<a href="{url}" class="m-menu__link"><span class="m-menu__item-here"></span>{icon}{label}</a>';

  public $labelTemplate = '{icon}{label}';

  public $submenuTemplate = "<div class=\"m-menu__submenu \"><span class=\"m-menu__arrow\"></span>\n<ul class=\"m-menu__subnav\">\n{items}\n</ul>\n</div>";

  public $itemOptions = ['class' => 'm-menu__item'];

  public $options = ['class' => 'm-menu__nav  m-menu__nav--dropdown-submenu-arrow'];

  public function init()
  {
    if ($this->route === null && Yii::$app->controller !== null) {
      $this->route = Yii::$app->controller->getRoute();
    }
    if ($this->params === null) {
      $this->params = Yii::$app->request->getQueryParams();
    }

    $countItems = count($this->items);
    foreach ($this->items as $index => $item) {
      if(!empty($item['items'])){
        $item['options'] = [
          'class' => 'm-menu__item  m-menu__item--submenu',
          'aria-haspopup' => 'true',
          'm-menu-submenu-toggle' => 'hover',
        ];
        $item['linkTemplate'] = '<a href="{url}" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span>{icon}{label}<i
                class="m-menu__ver-arrow la la-angle-right"></i></a>';
        $flag = false;
        foreach($item['items'] as $subIndex => $subitem) {
          if($item['itemsIcon']) {
            $subitem['icon'] = $item['itemsIcon'];
          }
          if($this->isItemActive($subitem)){
            $flag = true;
          }
          $item['items'][$subIndex] = $subitem;
        }
        if($flag) {
          $item['options']['class'] .= ' m-menu__item--open m-menu__item--expanded';
        }
      }
      if($item['submenuUp'] || $index == $countItems - 1)
      {
        $item['submenuTemplate'] = "<div class=\"m-menu__submenu m-menu__submenu--up\"><span class=\"m-menu__arrow\"></span>\n<ul class=\"m-menu__subnav\">\n{items}\n</ul>\n</div>";
      }
      $this->items[$index] = $item;
    }

    parent::init();
  }

  public function run()
  {
    echo '<div
        id="m_ver_menu"
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown "
        data-menu-vertical="true"
        m-menu-dropdown="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500"
        >';
    parent::run();
    echo '</div>';
  }

  protected function renderItem($item)
  {
    if($item['icon']){
      switch($item['icon']) {
        case 'dot' :
          $item['icon'] = '<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>';
          break;
        case 'line' :
          $item['icon'] = '<i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>';
          break;
        default:
          $item['icon'] = '<i class="m-menu__link-icon ' . $item['icon'] . '"></i>';
      }
    }
    $item['label'] = $item['label'] ? ('<span class="m-menu__link-text">' . $item['label'] . '</span>') : '';
    if (isset($item['url'])) {
      $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

      return strtr($template, [
        '{url}' => Html::encode(Url::to($item['url'])),
        '{label}' => $item['label'],
        '{icon}' => $item['icon'],
      ]);
    }

    $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

    return strtr($template, [
      '{label}' => $item['label'],
      '{icon}' => $item['icon'],
    ]);
  }


}