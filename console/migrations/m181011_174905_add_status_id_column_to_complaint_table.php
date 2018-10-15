<?php

use yii\db\Migration;

/**
 * Handles adding status_id to table `complaint`.
 */
class m181011_174905_add_status_id_column_to_complaint_table extends Migration
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

        if ($this->db->getTableSchema('{{%complaint_status_lang}}', true))
            $this->dropTable('{{%complaint_status_lang}}');
        if ($this->db->getTableSchema('{{%complaint_status}}', true))
            $this->dropTable('{{%complaint_status}}');

        $this->createTable('{{%complaint_status}}', [
          'id' => $this->integer()->notNull()->unique(),
          'created_at' => $this->integer()->notNull(),
          'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addPrimaryKey('pk-complaint_status-id', '{{%complaint_status}}', 'id');
        $this->createTable('{{%complaint_status_lang}}', [
          'id' => $this->primaryKey(),
          'entity_id' => $this->integer()->notNull(),
          'lang_id' => $this->integer()->notNull(),
          'name' => $this->string(255)->notNull(),
        ], $tableOptions);
        $this->addForeignKey('fk-complaint_status_lang-entity_id', '{{%complaint_status_lang}}', 'entity_id', '{{%complaint_status}}', 'id', 'CASCADE');
        $this->insert('{{%complaint_status}}', ['id' => 1, 'created_at' => time(), 'updated_at' => time()]);
        $this->batchInsert('{{%complaint_status_lang}}', ['entity_id', 'lang_id', 'name'], [
          [1, 1, 'В обработке'],
          [1, 2, 'В обробці'],
        ]);
        $this->insert('{{%complaint_status}}', ['id' => 2, 'created_at' => time(), 'updated_at' => time()]);
        $this->batchInsert('{{%complaint_status_lang}}', ['entity_id', 'lang_id', 'name'], [
          [2, 1, 'Спам'],
          [2, 2, 'Спам'],
        ]);

        $this->addColumn('{{%complaint}}', 'status_id', $this->integer()->notNull()->defaultValue(1));
        $this->addForeignKey('fk-complaint-status_id', '{{%complaint}}', 'status_id', '{{%complaint_status}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
