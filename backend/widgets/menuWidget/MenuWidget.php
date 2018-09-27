<?php
namespace backend\widgets\menuWidget;

use backend\components\metronic\widgets\Menu;
use yii\helpers\Url;

class MenuWidget extends Menu
{
    public function renderItems($items, $level = 1)
    {
        $this->setActiveItems($items);

        return parent::renderItems($items, $level);
    }

    /**
     * @param $items
     */
    protected function setActiveItems(&$items)
    {
        foreach ($items as &$item) {
            if( $item['active'] !== true ) {

                $baseUrl = \Yii::$app->request->absoluteUrl;

                $activeFor = $item['activeFor'];
                if (is_array($activeFor)) {
                    foreach ($activeFor as &$val) {
                        if( stristr($baseUrl, $val) ) {
                            $item['active'] = true;
                            break;
                        }
                    }
                } else {
                    if( stristr($baseUrl, $activeFor) ) {
                        $item['active'] = true;
                    }
                }

                if(isset($item['items'])) {
                    $this->setActiveItems($item['items']);
                }
            }
        }
    }

    public function renderItem($item)
    {
        return parent::renderItem($item);
    }
}
