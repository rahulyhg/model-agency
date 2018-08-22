<?php

namespace backend\lib\contexts;


use backend\models\Context;
use backend\models\Deal;
use backend\models\MoneyFlow;
use yii\helpers\ArrayHelper;

class DealContext implements IContext
{
    const UID = 1;

    public function getMap()
    {
        return ArrayHelper::map(Deal::find()->all(), 'id', 'name');
    }

    public function getName($id)
    {
        /**
         * @var $model Deal
         */
        $model = Deal::findOne($id);
        return $model ? $model->name : null;
    }

    public function canDelete($id, &$error)
    {
        /**
         * @var $model Context
         */
        $model = Context::findOne(['uid' => self::UID]);
        if ($model && MoneyFlow::find()->where(['context_id' => $model->id, 'context_object_id' => $id])->count() > 0){
            $error = 'Нельзя удалить сделку #'.$id.', которая имеет записи в финансах.';
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