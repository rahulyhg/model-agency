<?php
namespace modules\mod;

class Module extends \common\lib\Module
{
  public function init()
  {
    \Yii::$app->mailer->viewPath = '@modules/mod/mail';
    parent::init();
  }
}