<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23.08.2018
 * Time: 13:39
 */

namespace backend\modules\asideMenu\widget;


use yii\base\Widget;

class AsideMenuWidget extends Widget
{
    public $items = [];
    public function run()
    {
        $items = $this->items;
        return $this->render('@app/modules/asideMenu/widget/view', ['items' => $items]);
    }
}