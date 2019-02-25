<?php

namespace common\lib;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ActiveRecord extends \yii\db\ActiveRecord
{
  public function behaviors()
  {
    try { // ВНИМАНИЕ! КОСТЫЛЬ!
      if ($this->hasAttribute('created_at') && !$this->hasAttribute('updated_at')) {
        return ArrayHelper::merge(parent::behaviors(), [
          [
            'class' => TimestampBehavior::class,
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => false,
          ]
				]);
			}
      if (!$this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
        return ArrayHelper::merge(parent::behaviors(), [
          [
            'class' => TimestampBehavior::class,
            'createdAtAttribute' => false,
            'updatedAtAttribute' => 'updated_at'
          ]
        ]);
      }
      if ($this->hasAttribute('created_at') || $this->hasAttribute('updated_at')) {
        return ArrayHelper::merge(parent::behaviors(), [
          [
            'class' => TimestampBehavior::class,
          ]
        ]);
      }
		} catch (\Exception $ex) {}
		return parent::behaviors();
	}

	public function getHiddenFormTokenField() {
		$token = \Yii::$app->getSecurity()->generateRandomString();
		$token = str_replace(' + ', ' . ', base64_encode($token));

		\Yii::$app->session->set(\Yii::$app->params['form_token_param'], $token);;
		return Html::hiddenInput(\Yii::$app->params['form_token_param'], $token);
	}
}