<?php

use yii\db\Migration;

/**
 * Class m180917_084115_first_migration
 */
class m180917_084115_first_migration extends Migration
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

    if ($this->db->getTableSchema('{{%complaint}}', true))
      $this->dropTable('{{%complaint}}');
    if ($this->db->getTableSchema('{{%service_bulletin}}', true))
      $this->dropTable('{{%service_bulletin}}');
    if ($this->db->getTableSchema('{{%attribute_val}}', true))
      $this->dropTable('{{%attribute_val}}');
    if ($this->db->getTableSchema('{{%bulletin_image}}', true))
      $this->dropTable('{{%bulletin_image}}');
    if ($this->db->getTableSchema('{{%bulletin}}', true))
      $this->dropTable('{{%bulletin}}');
    if ($this->db->getTableSchema('{{%bulletin_status_lang}}', true))
      $this->dropTable('{{%bulletin_status_lang}}');
    if ($this->db->getTableSchema('{{%bulletin_status}}', true))
      $this->dropTable('{{%bulletin_status}}');
    if ($this->db->getTableSchema('{{%service_lang}}', true))
      $this->dropTable('{{%service_lang}}');
    if ($this->db->getTableSchema('{{%service}}', true))
      $this->dropTable('{{%service}}');
    if ($this->db->getTableSchema('{{%category_attribute}}', true))
      $this->dropTable('{{%category_attribute}}');
    if ($this->db->getTableSchema('{{%category_attribute_group_lang}}', true))
      $this->dropTable('{{%category_attribute_group_lang}}');
    if ($this->db->getTableSchema('{{%category_attribute_group}}', true))
      $this->dropTable('{{%category_attribute_group}}');
    if ($this->db->getTableSchema('{{%category_lang}}', true))
      $this->dropTable('{{%category_lang}}');
    if ($this->db->getTableSchema('{{%category}}', true))
      $this->dropTable('{{%category}}');
    if ($this->db->getTableSchema('{{%attribute_lang}}', true))
      $this->dropTable('{{%attribute_lang}}');
    if ($this->db->getTableSchema('{{%attribute}}', true))
      $this->dropTable('{{%attribute}}');
    if ($this->db->getTableSchema('{{%attribute_type}}', true))
      $this->dropTable('{{%attribute_type}}');
    if ($this->db->getTableSchema('{{%client}}', true))
      $this->dropTable('{{%client}}');
    if ($this->db->getTableSchema('{{%location_lang}}', true))
      $this->dropTable('{{%location_lang}}');
    if ($this->db->getTableSchema('{{%location}}', true))
      $this->dropTable('{{%location}}');
    if ($this->db->getTableSchema('{{%lang}}', true))
      $this->dropTable('{{%lang}}');

    /**
     * lang draft
     */

    $this->createTable('{{%lang}}', [
      'id' => $this->integer()->notNull()->unique(),
      'name' => $this->string(64)->notNull(),
      'label' => $this->string(64),
      'ietf_tag' => $this->string(64)->notNull(),
      'is_default' => $this->boolean()->notNull()->defaultValue(0),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addPrimaryKey('pk-lang-id', '{{%lang}}', 'id');
    $this->batchInsert('{{%lang}}', ['id', 'name', 'label', 'ietf_tag', 'is_default', 'created_at', 'updated_at'], [
      [1, 'Русский', 'язык', 'ru', 1, time(), time()],
      [2, 'Украинский', 'мова', 'uk', 0, time(), time()],
    ]);

    /**
     * location draft
     */

    $this->createTable('{{%location}}', [
      'id' => $this->primaryKey(),
    ], $tableOptions);
    $this->createTable('{{%location_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-location_lang-entity_id', '{{%location_lang}}', 'entity_id', '{{%location}}', 'id', 'CASCADE');


    /**
     * client
     */

    $this->createTable('{{%client}}', [
      'id' => $this->primaryKey(),
      'avatar_id' => $this->integer(),
      'email' => $this->string()->notNull()->unique(),
      'phone' => $this->string()->notNull()->unique(),
      'auth_key' => $this->string(32)->notNull(),
      'password_hash' => $this->string()->notNull(),
      'password_reset_token' => $this->string()->unique(),
      'location_id' => $this->integer(),
      'status' => $this->integer()->notNull()->defaultValue(10),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-client-location_id', '{{%client}}', 'location_id', '{{%location}}', 'id');

    /**
     * attributes
     */

    $this->createTable('{{%attribute_type}}', [
      'id' => $this->primaryKey(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);

    $this->createTable('{{%attribute}}', [
      'id' => $this->primaryKey(),
      'type_id' => $this->integer()->notNull(),
      'type_settings' => $this->text(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-attribute-type_id', '{{%attribute}}', 'type_id', '{{%attribute_type}}', 'id');
    $this->createTable('{{%attribute_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-attribute_lang-entity_id', '{{%attribute_lang}}', 'entity_id', '{{%attribute}}', 'id', 'CASCADE');

    /**
     * category
     */

    $this->createTable('{{%category}}', [
      'id' => $this->primaryKey(),
      'parent_id' => $this->integer(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-category-parent_id', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'CASCADE');
    $this->createTable('{{%category_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-category_lang-entity_id', '{{%category_lang}}', 'entity_id', '{{%category}}', 'id', 'CASCADE');

    /**
     * category attribute
     */

    $this->createTable('{{%category_attribute_group}}', [
      'id' => $this->primaryKey(),
      'parent_id' => $this->integer(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-c_a_g-parent_id', '{{%category_attribute_group}}', 'parent_id', '{{%category_attribute_group}}', 'id', 'CASCADE');
    $this->createTable('{{%category_attribute_group_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255),
    ], $tableOptions);
    $this->addForeignKey('fk-c_a_g_lang-entity_id', '{{%category_attribute_group_lang}}', 'entity_id', '{{%category_attribute_group}}', 'id', 'CASCADE');

    $this->createTable('{{%category_attribute}}', [
      'id' => $this->primaryKey(),
      'category_id' => $this->integer()->notNull(),
      'attribute_id' => $this->integer()->notNull(),
      'group_id' => $this->integer()->notNull(),
      'position' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-category_attribute-category_id', '{{%category_attribute}}', 'category_id', '{{%category}}', 'id', 'CASCADE');
    $this->addForeignKey('fk-category_attribute-attribute_id', '{{%category_attribute}}', 'attribute_id', '{{%attribute}}', 'id', 'CASCADE');
    $this->addForeignKey('fk-category_attribute-group_id', '{{%category_attribute}}', 'group_id', '{{%category_attribute_group}}', 'id', 'CASCADE');

    /**
     * service
     */

    $this->createTable('{{%service}}', [
      'id' => $this->primaryKey(),
      'duration' => $this->integer()->notNull(),
      'price' => $this->decimal(20, 3)->notNull(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->createTable('{{%service_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255)->notNull(),
      'description' => $this->text(),
    ], $tableOptions);
    $this->addForeignKey('fk-service_lang-entity_id', '{{%service_lang}}', 'entity_id', '{{%service}}', 'id', 'CASCADE');

    /**
     * bulletin
     */

    $this->createTable('{{%bulletin_status}}', [
      'id' => $this->integer()->notNull()->unique(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addPrimaryKey('pk-bulletin_status-id', '{{%bulletin_status}}', 'id');
    $this->createTable('{{%bulletin_status_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'lang_id' => $this->integer()->notNull(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-bulletin_status_lang-entity_id', '{{%bulletin_status_lang}}', 'entity_id', '{{%bulletin_status}}', 'id', 'CASCADE');
    $this->insert('{{%bulletin_status}}', ['id' => 1, 'created_at' => time(), 'updated_at' => time()]);
    $this->batchInsert('{{%bulletin_status_lang}}', ['entity_id', 'lang_id', 'name'], [
      [1, 1, 'Опубликовано'],
      [1, 2, 'Опубліковано'],
    ]);
    $this->insert('{{%bulletin_status}}', ['id' => 2, 'created_at' => time(), 'updated_at' => time()]);
    $this->batchInsert('{{%bulletin_status_lang}}', ['entity_id', 'lang_id', 'name'], [
      [2, 1, 'Черновик'],
      [2, 2, 'Чернетка'],
    ]);

    $this->createTable('{{%bulletin}}', [
      'id' => $this->primaryKey(),
      'title' => $this->string(255)->notNull(),
      'content' => $this->text()->notNull(),
      'location_id' => $this->integer()->notNull(),
      'client_id' => $this->integer()->notNull(),
      'category_id' => $this->integer()->notNull(),
      'status_id' => $this->integer()->notNull(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-bulletin-client_id', '{{%bulletin}}', 'client_id', '{{%client}}', 'id');
    $this->addForeignKey('fk-bulletin-category_id', '{{%bulletin}}', 'category_id', '{{%category}}', 'id');
    $this->addForeignKey('fk-bulletin-location_id', '{{%bulletin}}', 'location_id', '{{%location}}', 'id');

    $this->createTable('{{%bulletin_image}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'image_id' => $this->integer()->notNull(),
      'position' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-bulletin_image-entity_id', '{{%bulletin_image}}', 'entity_id', '{{%bulletin}}', 'id', 'CASCADE');

    /**
     * bulletin attribute
     */

    $this->createTable('{{%attribute_val}}', [
      'id' => $this->primaryKey(),
      'attribute_id' => $this->integer()->notNull(),
      'entity_id' => $this->integer()->notNull(),
      'val' => $this->text(),
    ], $tableOptions);
    $this->addForeignKey('fk-attribute_val-attribute_id', '{{%attribute_val}}', 'attribute_id', '{{%attribute}}', 'id');
    $this->addForeignKey('fk-attribute_val-entity_id', '{{%attribute_val}}', 'entity_id', '{{%bulletin}}', 'id', 'CASCADE');

    /**
     * bulletin service
     */

    $this->createTable('{{%service_bulletin}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'service_id' => $this->integer()->notNull(),
      'expires_at' => $this->integer()->notNull(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-service_bulletin-service_id', '{{%service_bulletin}}', 'service_id', '{{%service}}', 'id');
    $this->addForeignKey('fk-service_bulletin-entity_id', '{{%service_bulletin}}', 'entity_id', '{{%bulletin}}', 'id', 'CASCADE');

    /**
     * complaint
     */

    $this->createTable('{{%complaint}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer()->notNull(),
      'subject' => $this->string(255)->notNull(),
      'content' => $this->text()->notNull(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);
    $this->addForeignKey('fk-complaint-entity_id', '{{%complaint}}', 'entity_id', '{{%bulletin}}', 'id', 'CASCADE');

  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropForeignKey('fk-complaint-entity_id', '{{%complaint}}');
    $this->dropTable('{{%complaint}}');

    $this->dropForeignKey('fk-service_bulletin-service_id', '{{%service_bulletin}}');
    $this->dropForeignKey('fk-service_bulletin-entity_id', '{{%service_bulletin}}');
    $this->dropTable('{{%service_bulletin}}');

    $this->dropForeignKey('fk-attribute_val-attribute_id', '{{%attribute_val}}');
    $this->dropForeignKey('fk-attribute_val-entity_id', '{{%attribute_val}}');
    $this->dropTable('{{%attribute_val}}');

    $this->dropForeignKey('fk-bulletin_image-entity_id', '{{%bulletin_image}}');
    $this->dropTable('{{%bulletin_image}}');

    $this->dropForeignKey('fk-bulletin-client_id', '{{%bulletin}}');
    $this->dropForeignKey('fk-bulletin-category_id', '{{%bulletin}}');
    $this->dropForeignKey('fk-bulletin-location_id', '{{%bulletin}}');
    $this->dropTable('{{%bulletin}}');

    $this->dropForeignKey('fk-bulletin_status_lang-entity_id', '{{%bulletin_status_lang}}');
    $this->dropTable('{{%bulletin_status_lang}}');
    $this->dropTable('{{%bulletin_status}}');

    $this->dropForeignKey('fk-service_lang-entity_id', '{{%service_lang}}');
    $this->dropTable('{{%service_lang}}');
    $this->dropTable('{{%service}}');

    $this->dropForeignKey('fk-category_attribute-category_id', '{{%category_attribute}}');
    $this->dropForeignKey('fk-category_attribute-attribute_id', '{{%category_attribute}}');
    $this->dropForeignKey('fk-category_attribute-group_id', '{{%category_attribute}}');
    $this->dropTable('{{%category_attribute}}');

    $this->dropForeignKey('fk-c_a_g_lang-entity_id', '{{%category_attribute_group_lang}}');
    $this->dropTable('{{%category_attribute_group_lang}}');
    $this->dropForeignKey('fk-c_a_g-parent_id', '{{%category_attribute_group}}');
    $this->dropTable('{{%category_attribute_group}}');

    $this->dropForeignKey('fk-category_lang-entity_id', '{{%category_lang}}');
    $this->dropTable('{{%category_lang}}');
    $this->dropForeignKey('fk-category-parent_id', '{{%category}}');
    $this->dropTable('{{%category}}');

    $this->dropForeignKey('fk-attribute_lang-entity_id', '{{%attribute_lang}}');
    $this->dropTable('{{%attribute_lang}}');
    $this->dropForeignKey('fk-attribute-type_id', '{{%attribute}}');
    $this->dropTable('{{%attribute}}');
    $this->dropTable('{{%attribute_type}}');

    $this->dropForeignKey('fk-client-location_id', '{{%client}}');
    $this->dropTable('{{%client}}');

    $this->dropForeignKey('fk-location_lang-entity_id', '{{%location_lang}}');
    $this->dropTable('{{%location_lang}}');
    $this->dropTable('{{%location}}');

    $this->dropTable('{{%lang}}');
  }
}
