<?php

use yii\db\Migration;

/**
 * Class m190121_195439_add_photo_id_to_mod_user_talbe
 */
class m190121_195439_add_photo_id_to_mod_user_talbe extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('{{%mod_user}}', 'photo_id', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('{{%mod_user}}', 'photo_id');
    }
}
