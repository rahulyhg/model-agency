<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bulletin_stat`.
 */
class m181107_141604_create_bulletin_stat_table extends Migration
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

    if ($this->db->getTableSchema('{{%bulletin_stat}}', true))
      $this->dropTable('{{%bulletin_stat}}');

    $this->createTable('{{%bulletin_stat}}', [
      'id' => $this->primaryKey(),
      'bulletin_id' => $this->integer(11)->notNull(),
      'views' => $this->integer(11)->notNull()->defaultValue(0),
      'phoneViews' => $this->integer(11)->notNull()->defaultValue(0),
    ]);
    $this->addForeignKey('fk-bulletin_stat-bulletin', '{{%bulletin_stat}}', 'bulletin_id', '{{%bulletin}}', 'id', 'CASCADE');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('{{%bulletin_stat}}');
  }
}
