<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.09.2018
 * Time: 16:21
 */

namespace backend\widgets;


class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
  public $options = ['class' => 'm-subheader__breadcrumbs m-nav m-nav--inline'];

  public $itemTemplate = "<li class=\"m-nav__item\">{link}</li>\n<li class=\"m-nav__separator\">-</li>\n";

  public $activeItemTemplate = "<li class=\"m-nav__item\">{link}</li>\n";

  public $encodeLabels = false;

  public function init()
  {
    $this->homeLink = [
      'label' => '<i class="m-nav__link-icon la la-home"></i>',
      'url' => \Yii::$app->homeUrl,
      'class' => 'm-nav__link m-nav__link--icon',
      'template' => "<li class=\"m-nav__item\">{link}</li>\n<li class=\"m-nav__separator\">-</li>\n",
    ];

    foreach($this->links as $index => $link) {
      if(is_array($link)){
        $link['class'] = $link['class'] ? : 'm-nav__link';
        $link['label'] = '<span class="m-nav__link-text">'.$link['label'].'</span>';
        $this->links[$index] = $link;
      }
    }

    parent::init();
  }
}