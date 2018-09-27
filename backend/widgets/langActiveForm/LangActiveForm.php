<?php
/**
 *
 */

namespace backend\widgets\langActiveForm;

use backend\widgets\activeForm\ActiveForm;
use common\lib\SmBackendView;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\widgets\ActiveField;

/**
 * Class LangActiveForm
 * @package backend\widgets\langActiveForm
 */
class LangActiveForm extends ActiveForm
{
    public $langSelector;
    public $defaultLangInd;
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->view->on(SmBackendView::EVENT_END_PAGE, [$this, 'registerLangJs']);
        parent::init();
    }

    protected function registerLangJs()
    {
        $path = \Yii::getAlias("@backend/widgets/langActiveForm/assets/langActiveForm.js");
        $url = \Yii::$app->assetManager->publish($path);
        echo Html::jsFile($url[1], [
            'data-formid' => $this->options['id'],
            'data-deflangind' => $this->defaultLangInd,
        ]);
    }

    /**
     * @param \yii\base\Model|\yii\base\Model[] $model
     * @param string $attribute
     * @param array $options
     * @return LangActiveField|ActiveField
     */
    public function field($model, $attribute, $options = [])
    {
        if(is_array($model)){
            $f = parent::field($model[0], $attribute, $options);
            return new LangActiveField($f, $model, $attribute);
        }
        return parent::field($model, $attribute, $options);
    }
}