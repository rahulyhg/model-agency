<?php

namespace common\initializers;

use yii\base\Application;
use yii\base\Behavior;
use yii\helpers\VarDumper;

class ApplicationInitializer extends Behavior
{
  public function events()
  {
    return [
      Application::EVENT_BEFORE_REQUEST => 'beforeRequest',
    ];
  }

  public function beforeRequest()
  {
    foreach (\Yii::$app->modules as $module) {
      if( is_array($module) ) {
        $className = $module['class'];
      } elseif(is_object($module)) {
        $className = get_class($module);
      } else {
        return;
      }
      if(class_exists($className)) {
        $rc = new \ReflectionClass($className);
        foreach ($rc->getMethods(\ReflectionMethod::IS_STATIC) as $method) {
          if( $method->name === 'registerTranslations' ) {
            $className::registerTranslations();
          }
        }
      }
    }
  }
}