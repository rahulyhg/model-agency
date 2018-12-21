<?php

use yii\db\Migration;

/**
 * Class m181221_091658_create_table_images_basket
 */
class m181221_091658_create_table_images_basket extends Migration
{
  /**
   * id
   * basket_id - Mod->images_basket_id
   * image_id - filestorage file->id
   */

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('{{%images_basket}}', [
        'id' => $this->primaryKey(),
        'basket_id' => $this->integer(11)->notNull(),
        'image_id' => $this->integer(11)->notNull(),
        'created_at' => $this->integer(11),
        'updated_at' => $this->integer(11),
      ]);

      $this->addForeignKey('fk-images_basket-filestorage', '{{%images_basket}}', 'image_id', '{{%filestorage}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('fk-images_basket-filestorage', '{{%images_basket}}');

      $this->dropTable('{{%images_basket}}');
    }
}
