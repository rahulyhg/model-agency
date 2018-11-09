<?php
namespace modules\lang\components;

use modules\lang\common\models\Lang;
use yii\web\UrlManager;

class LangUrlManager extends UrlManager
{
  public function createUrl($params)
  {
    if( isset($params['lang_id']) ) {
      //Если указан идентификатор языка, то делаем попытку найти язык в БД,
      //иначе работаем с языком по умолчанию
      $lang = Lang::findOne($params['lang_id']);
      if( $lang === null ){
        $lang = Lang::getDefaultLang();
      }
      unset($params['lang_id']);
    } else {
      //Если не указан параметр языка, то работаем с текущим языком
      $lang = Lang::getCurrent();
    }
    //Получаем сформированный URL(без префикса идентификатора языка)
    $url = parent::createUrl($params);
    // Если это язык по-умолчанию, префикс не нужен
    if( $lang->is_default ) {
      return $url;
    }
    //Добавляем к URL префикс - буквенный идентификатор языка
    if( $url == '/' ) {
      return '/'.$lang->ietf_tag;
    }else{
      return '/'.$lang->ietf_tag.$url;
    }
  }
}