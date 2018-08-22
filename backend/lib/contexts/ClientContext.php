<?php

namespace backend\lib\contexts;


use common\models\Client;
use backend\models\Context;
use backend\models\MoneyFlow;
use yii\helpers\ArrayHelper;

class ClientContext implements IContext
{
    const UID = 2;

    public function getMap()
    {
        return ArrayHelper::map(Client::find()->all(), 'id', 'fullNameWithId');
    }

    public function getName($id)
    {
        $client = Client::findOne($id);
        return $client !== null ? $client->getFullNameWithId() : null;
    }

    public function canDelete($id, &$error)
    {
        /**
         * @var $model Context
         */
        $model = Context::findOne(['uid' => self::UID]);
        if ($model && MoneyFlow::find()->where(['context_id' => $model->id, 'context_object_id' => $id])->count() > 0){
            $error = 'Нельзя удалить клиента #'.$id.', который имеет записи в финансах.';
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