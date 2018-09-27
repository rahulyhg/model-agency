<?php
/**
 *
 */

namespace backend\widgets\multipleDelete;

use backend\widgets\langActiveForm\LangActiveForm;
use Codeception\Exception\ConfigurationException;
use common\lib\SmActiveRecord;
use ReflectionFunction;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

class MultipleDelete extends Widget
{
    public $deleteConfirm = 'Вы уверены, что хотите удалить?';

    /**
     * @var string|array
     */
    public $url = ['multiple-delete'];

    public $btnClass = 'btn btn-danger';

    public $btnText = '<span class="fa fa-trash "></span> Удалить';

    public $gridId;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if(!isset($this->gridId))
            throw new InvalidConfigException('"gridId" should be set');
        parent::init();
    }

    /**
     * Run widget
     */
    public function run()
    {
        MultipleDeleteAsset::register($this->getView());
        return Html::button($this->btnText, [
            'class' => $this->btnClass . ' multiple-delete',
            'data-gridid' => $this->gridId,
            'data-deleteconfirm' => $this->deleteConfirm,
            'data-url' => Url::to($this->url),
        ]);
    }
}