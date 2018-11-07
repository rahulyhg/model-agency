<?php

use yii\db\Migration;

/**
 * Class m181018_095921_create_geo_tables
 */
class m181018_095921_create_geo_tables extends Migration
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

    $this->createTable('{{%region}}', [
      'id' => $this->primaryKey(),
    ], $tableOptions);
    $this->createTable('{{%region_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-region_lang-entity_id', '{{%region_lang}}', 'entity_id', '{{%region}}', 'id', 'CASCADE');

    $this->createTable('{{%raion}}', [
      'id' => $this->primaryKey(),
    ], $tableOptions);
    $this->createTable('{{%raion_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-raion_lang-entity_id', '{{%raion_lang}}', 'entity_id', '{{%raion}}', 'id', 'CASCADE');

    $this->createTable('{{%city_district}}', [
      'id' => $this->primaryKey(),
      'city_id' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-city_district-city_id', '{{%city_district}}', 'city_id', '{{%location}}', 'id', 'CASCADE');
    $this->createTable('{{%city_district_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-city_district_lang-entity_id', '{{%city_district_lang}}', 'entity_id', '{{%city_district}}', 'id', 'CASCADE');

    $this->addColumn('{{%location}}', 'region_id', $this->integer());
    $this->addForeignKey('fk-location-region_id', '{{%location}}', 'region_id', '{{%region}}', 'id', 'SET NULL');

    $this->addColumn('{{%location}}', 'raion_id', $this->integer());
    $this->addForeignKey('fk-location-raion_id', '{{%location}}', 'raion_id', '{{%raion}}', 'id', 'SET NULL');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    echo "m181018_095921_create_geo_tables cannot be reverted.\n";

    return false;
  }

  /*
  // Use up()/down() to run migration code without a transaction.
  public function up()
  {

  }

  public function down()
  {
      echo "m181018_095921_create_geo_tables cannot be reverted.\n";

      return false;
  }
  */
}
