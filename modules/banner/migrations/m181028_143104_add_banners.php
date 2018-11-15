<?php

use yii\db\Migration;

/**
 * Class m181028_143104_add_banners
 */
class m181028_143104_add_banners extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->delete('{{%banner}}', ['position' => 'single_adv_bottom']);
    $this->delete('{{%banner}}', ['position' => 'single_adv_right']);
    $this->delete('{{%banner}}', ['position' => 'single_adv_top']);
    $this->delete('{{%banner}}', ['position' => 'category_sidebar']);

    $this->insert('{{%banner}}', [
      'position' => 'home_inside_recent_ads',
      'name' => 'Внутри последних объявлений на главной',
      'text' => '<a class="b-place-for-ads b-place-for-ads_light b-recent-announcements__place-for-ads b-recent-announcements__place-for-ads_small"
                           href="#" title="Рекламное объявление">
                            <div class="b-place-for-ads__text">Баннер</div>
            
                            <div class="b-place-for-ads__size">470 Х 200</div>
                        </a>
            
                        <a class="b-place-for-ads b-place-for-ads_light b-recent-announcements__place-for-ads b-recent-announcements__place-for-ads_large"
                           href="#" title="Рекламное объявление">
                            <div class="b-place-for-ads__text">Баннер</div>
            
                            <div class="b-place-for-ads__size">670 Х 200</div>
                        </a>',
      'created_at' => time(),
      'updated_at' => time(),
    ]);
    $this->insert('{{%banner}}', [
      'position' => 'footer_right',
      'name' => 'Баннер в подвале справа',
      'text' => '<a class="b-place-for-ads b-place-for-ads_light b-footer__place-for-ads" href="#"><div class="b-place-for-ads__text">Баннер</div><div class="b-place-for-ads__size">570 Х 120</div></a>',
      'created_at' => time(),
      'updated_at' => time(),
    ]);
    $this->insert('{{%banner}}', [
      'position' => 'single_adv_top',
      'name' => 'На странице объявления вверху',
      'text' => '<a class="b-place-for-ads b-main__place-for-ads b-main__place-for-ads_sm" href="#" title="Рекламное объявление">
                            <div class="b-place-for-ads__text">Баннер</div>
        
                            <div class="b-place-for-ads__size">570 Х 140</div>
                        </a>
        
                        <a class="b-place-for-ads b-main__place-for-ads b-main__place-for-ads_lg" href="#" title="Рекламное объявление">
                            <div class="b-place-for-ads__text">Баннер</div>
        
                            <div class="b-place-for-ads__size">770 Х 140</div>
                        </a>',
      'created_at' => time(),
      'updated_at' => time(),
    ]);
    $this->insert('{{%banner}}', [
      'position' => 'single_adv_right',
      'name' => 'На странице объявления справа',
      'text' => '<a class="b-place-for-ads b-sidebar__place-for-ads" href="#" title="Рекламное объявление">
                            <div class="b-place-for-ads__text">Баннер</div>
    
                            <div class="b-place-for-ads__size">270 Х 475</div>
                        </a>
    
                        <a class="b-place-for-ads b-sidebar__place-for-ads" href="#" title="Рекламное объявление">
                            <div class="b-place-for-ads__text">Баннер</div>
    
                            <div class="b-place-for-ads__size">270 Х 475</div>
                        </a>',
      'created_at' => time(),
      'updated_at' => time(),
    ]);
    $this->insert('{{%banner}}', [
      'position' => 'single_adv_bottom',
      'name' => 'На странице объявления внизу',
      'text' => '<a class="b-place-for-ads b-content__place-for-ads" href="#" title="Рекламное объявление">
                            <div class="b-place-for-ads__text">Баннер</div>
    
                            <div class="b-place-for-ads__size">870 Х 140</div>
                        </a>
    
                        <a class="b-place-for-ads b-content__place-for-ads" href="#" title="Рекламное объявление">
                            <div class="b-place-for-ads__text">Баннер</div>
    
                            <div class="b-place-for-ads__size">870 Х 140</div>
                        </a>',
      'created_at' => time(),
      'updated_at' => time(),
    ]);
    $this->insert('{{%banner}}', [
      'position' => 'category_sidebar',
      'name' => 'На странице категории справа',
      'text' => '<a class="b-place-for-ads b-sidebar__place-for-ads" href="#" title="Рекламное объявление"><div class="b-place-for-ads__text">Баннер</div><div class="b-place-for-ads__size">270 Х 475</div></a><a class="b-place-for-ads b-sidebar__place-for-ads" href="#" title="Рекламное объявление"><div class="b-place-for-ads__text">Баннер</div><div class="b-place-for-ads__size">270 Х 475</div></a>',
      'created_at' => time(),
      'updated_at' => time(),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->delete('{{%banner}}', ['position' => 'single_adv_bottom']);
    $this->delete('{{%banner}}', ['position' => 'single_adv_right']);
    $this->delete('{{%banner}}', ['position' => 'single_adv_top']);
    $this->delete('{{%banner}}', ['position' => 'category_sidebar']);
  }
}
