<?php
namespace backend\widgets;

use Yii;
use yii\helpers\ArrayHelper;

class Alert extends \common\widgets\Alert
{
	/**
	 * {@inheritdoc}
	 */
	public function run()
	{
		$this->closeButton = ArrayHelper::merge([
			'label' => ''
		], $this->closeButton);

		parent::run();
	}
}