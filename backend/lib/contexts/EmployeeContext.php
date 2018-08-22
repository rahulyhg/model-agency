<?php

namespace backend\lib\contexts;


use backend\models\Context;
use common\models\Employee;
use backend\models\MoneyFlow;
use yii\helpers\ArrayHelper;

class EmployeeContext implements IContext
{
    const UID = 3;

    public function getMap()
    {
        return ArrayHelper::map(Employee::find()->all(), 'id', 'fullName');
    }

    public function getName($id)
    {
        $client = Employee::findOne($id);
        return $client !== null ? $client->getFullName() : null;
    }

    public function canDelete($id, &$error)
    {
        /**
         * @var $model Context
         */
        $model = Context::findOne(['uid' => self::UID]);
        if ($model && MoneyFlow::find()->where(['context_id' => $model->id, 'context_object_id' => $id])->count() > 0){
            $error = 'Нельзя удалить сотрудника #'.$id.', который имеет записи в финансах.';
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