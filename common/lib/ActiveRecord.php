<?php
namespace common\lib;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class ActiveRecord extends \yii\db\ActiveRecord
{
	public function behaviors() {
		try { // ВНИМАНИЕ! КОСТЫЛЬ!
			if( $this->hasAttribute('created_at') || $this->hasAttribute('updated_at') ) {
				return ArrayHelper::merge(parent::behaviors(), [
					TimestampBehavior::class,
				]);
			}
		} catch (\Exception $ex) {}
		return parent::behaviors();
	}
}