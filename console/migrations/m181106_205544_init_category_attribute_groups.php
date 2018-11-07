<?php

use yii\db\Migration;

/**
 * Class m181106_205544_init_category_attribute_groups
 */
class m181106_205544_init_category_attribute_groups extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $uids = [1, 2, 3, 4];
    $presets = \modules\bulletin\common\models\CategoryAttributeGroup::findPresets()->all();
    $presetUids = \yii\helpers\ArrayHelper::getColumn($presets, 'uid');
    $uids = array_diff($uids, $presetUids);
    if (!empty($uids)) {
      foreach ($uids as $uid) {
        $this->insert('{{%category_attribute_group}}', [
          'created_at' => time(), 'updated_at' => time(), 'uid' => $uid
        ]);
        $this->insert('{{%category_attribute_group_lang}}', [
          'entity_id' => Yii::$app->db->lastInsertID, 'lang_id' => 1, 'name' => "Колонка $uid",
        ]);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    echo "m181106_205544_init_category_attribute_groups cannot be reverted.\n";

    return false;
  }

  /*
  // Use up()/down() to run migration code without a transaction.
  public function up()
  {

  }

  public function down()
  {
      echo "m181106_205544_init_category_attribute_groups cannot be reverted.\n";

      return false;
  }
  */
}
