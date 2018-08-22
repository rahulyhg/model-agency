<?php
namespace common\lib;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class ActiveRecord extends \yii\db\ActiveRecord
{
	public function behaviors() {
		if( $this->hasAttribute('created_at') && $this->hasAttribute('updated_at') ) {
			return ArrayHelper::merge(parent::behaviors(), [
				[
					'class' => TimestampBehavior::class,
					'createdAtAttribute' => 'created_at',
					'updatedAtAttribute' => 'updated_at'
				]
			]);
		} elseif($this->hasAttribute('created_at')) {
			return ArrayHelper::merge(parent::behaviors(), [
				[
					'class' => TimestampBehavior::class,
					'createdAtAttribute' => 'created_at',
				]
			]);
		} elseif($this->hasAttribute('updated_at')) {
			return ArrayHelper::merge(parent::behaviors(), [
				[
					'class' => TimestampBehavior::class,
					'updatedAtAttribute' => 'updated_at'
				]
			]);
		}
		return parent::behaviors();
	}
}