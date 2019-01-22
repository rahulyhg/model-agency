<?php
namespace backend\lib;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class ActiveRecord extends \yii\db\ActiveRecord
{
	public function behaviors() {
		$behaviors = [];
		if($this->canGetProperty('created_at') && $this->canGetProperty('updated_at')){
			$behaviors[] = [
				'class' => TimestampBehavior::class,
			];
		}
		return ArrayHelper::merge(parent::behaviors(), $behaviors);
	}
}