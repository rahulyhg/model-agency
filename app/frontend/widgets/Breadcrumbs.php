<?php
namespace frontend\widgets;


class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    public $options = ['class' => 'b-bread-crumbs__items'];

    public $itemTemplate = "<li class=\"b-bread-crumbs__item\">{link}</li>\n";

    public $activeItemTemplate = "<li class=\"b-bread-crumbs__item\">{link}</li>\n";

    public $encodeLabels = false;

    public function init()
    {
        $this->homeLink = [
            'label' => '<i class="b-bread-crumbs__item-icon pe-7s-home"></i> <span class="b-bread-crumbs__item-name">Главная страница</span>',
            'url' => \Yii::$app->homeUrl,
            'class' => 'b-bread-crumbs__item-link',
            'template' => "<li class=\"b-bread-crumbs__item\">{link}</li>",
        ];

        foreach($this->links as $index => $link) {
            if(is_array($link)){
                $link['class'] = $link['class'] ? : 'b-bread-crumbs__item-link';
                $link['label'] = '<span class="b-bread-crumbs__item-name">'.$link['label'].'</span>';
                $this->links[$index] = $link;
            }
        }

        parent::init();
    }
}