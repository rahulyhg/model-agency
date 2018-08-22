<?php

use yii\db\Migration;

/**
 * Class m180608_064004_add_columns_to_user_table
 */
class m180608_064004_add_columns_to_user_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->addColumn('{{%user}}', 'photo_file_id', $this->integer(11));
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropColumn('{{%user}}', 'photo_file_id');
	}
}
