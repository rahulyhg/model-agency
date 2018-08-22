<?php

namespace backend\widgets\crudButtons;

use backend\lib\ActiveRecord;
use yii\base\Widget;
use yii\helpers\Html;

class CrudButtons extends Widget
{
    /**
     * @var ActiveRecord
     */
    public $model;

    /**
     * @var string
     */
    public $template = '{delete} {index} {save}';

    /**
     * @var array
     */
    public $buttons = [];

    /**
     * @var string Delete confirm text
     */
    public $deleteConfirm = 'Вы уверены, что хотите удалить?';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initDefaultButtons();
    }

    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['index'])) {
            $this->buttons['index'] = function ($url, $model) {
                return Html::a('<span class="fa fa-list"></span>', $url, [
                    'class' => 'm-btn btn btn-secondary m-btn--custom m-btn--pill m-btn--custom',
                    'title' => 'Перейти к списку',
                    'id' => 'js-crud-list-btn'
                ]);
            };
        }
        if (!isset($this->buttons['save'])) {
            $this->buttons['save'] = function ($url, $model) {
                return Html::submitButton('<span><span class="la la-save"></span><span>Сохранить</span></span>', [
                    'class' => 'btn m-btn--pill m-btn--air btn-success m-btn--icon m-btn--custom',
                    'id' => 'js-crud-save-btn'
                ]);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model) {
                if($model->isNewRecord)
                    return false;
                $url['id'] = $model->id;
                return Html::a('<span class="fa fa-trash "></span>', $url, [
                    'id' => 'js-crud-delete-btn',
                    'class' => 'm-btn btn btn-danger m-btn--custom m-btn--pill m-btn--custom link-sweetalert',
                    'title' => 'Удалить',
                    'data-method' => 'post',
                    'data-title' => $this->deleteConfirm,
                    'data-type' => 'error',
                    'data-allow-outside-click' => 'true',
                    'data-show-confirm-button' => 'true',
                    'data-show-cancel-button' => 'true',
                    'data-confirm-button-class' => 'btn-danger',
                    'data-cancel-button-class' => 'btn-success',
                    'data-confirm-button-text' => 'Да',
                    'data-cancel-button-text' => 'Нет',
                ]);
            };
        }
    }

    /**
     * Run widget
     */
    public function run()
    {
        CrudButtonsAsset::register($this->getView());
        $buttons = $this->renderButtons($this->model);
        $this->view->registerJs("
        $(window).bind('keydown', function(event) {
            if (event.ctrlKey || event.metaKey) {
                switch (String.fromCharCode(event.which).toLowerCase()) {
                    case 's':
                        event.preventDefault();
                        $('#js-crud-save-btn').trigger('click');
                        break;
                    case 'l':
                        event.preventDefault();
                        window.location = $('#js-crud-list-btn').attr('href');
                        break;
                    case 'd':
                        event.preventDefault();
                        $('#js-crud-delete-btn').trigger('click');
                        break;
                }
            }
        });");
        return $buttons;
    }

    /**
     * @inheritdoc
     */
    protected function renderButtons($model)
    {
        return
		        preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) use ($model) {
		            $name = $matches[1];

		            if (isset($this->buttons[$name])) {
		                $url = [$name];
		                return call_user_func($this->buttons[$name], $url, $model);
		            } else {
		                return '';
		            }
		        }, $this->template);
    }
}