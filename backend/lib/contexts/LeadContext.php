<?php

namespace backend\lib\contexts;


use backend\models\Context;
use backend\models\Lead;
use backend\models\MoneyFlow;
use yii\helpers\ArrayHelper;

class LeadContext implements IContext
{
    const UID = 4;

    public function getMap()
    {
        return Lead::getMap();
    }

    public function getName($id)
    {
        /**
         * @var $model Lead
         */
        $model = Lead::findOne($id);
        return $model ? $model->fullTitle : null;
    }

    public function canDelete($id, &$error)
    {
        /**
         * @var $model Context
         */
        $model = Context::findOne(['uid' => self::UID]);
        if ($model && MoneyFlow::find()->where(['context_id' => $model->id, 'context_object_id' => $id])->count() > 0){
            $error = 'Нельзя удалить лид #'.$id.', который имеет записи в финансах.';
            return false;
        }
        return true;
    }

    public static function getId()
    {
        $model = Context::findOne(['uid' => self::UID]);
        if($model) {
            return $model->id;
        }
        return null;
    }
}