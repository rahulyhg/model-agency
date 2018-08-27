<?php

use yii\db\Migration;

/**
 * Class m180827_090513_init_ad_module
 */
class m180827_090513_init_ad_module extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%}}', [
      'id' => $this->primaryKey(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);

    $this->createTable('{{%}}', [
      'id' => $this->primaryKey(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);

    $this->createTable('{{%}}', [
      'id' => $this->primaryKey(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);

    $this->createTable('{{%}}', [
      'id' => $this->primaryKey(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);

    $this->createTable('{{%}}', [
      'id' => $this->primaryKey(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    echo "m180827_090513_init_ad_module cannot be reverted.\n";

    return false;
  }

  /*
  // Use up()/down() to run migration code without a transaction.
  public function up()
  {

  }

  public function down()
  {
      echo "m180827_090513_init_ad_module cannot be reverted.\n";

      return false;
  }
  */
}
