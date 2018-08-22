<?php
namespace common\components\filestorage\exceptions;

use Yii;
use yii\base\Exception;

class FileNotFoundException extends Exception
{
    public function __construct($message = null, $code = 0, $status = 500, \Exception $previous = null)
    {
        # Генерируем ответ
        $response = Yii::$app->getResponse();

        # Возвратим нужный статус (по-умолчанию отдадим 500-й)
        $response->setStatusCode($status);

        parent::__construct($message, $code, $previous);
    }
}