<?php

use yii\db\Migration;

/**
 * Class m190215_185013_init_spoken_lang_table
 */
class m190215_185013_init_spoken_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $langs = "азербайджанский|
албанский|
амхарский|
английский|
арабский|
армянский|
африкаанс|
баскский|
белорусский|
бенгальский|
бирманский|
болгарский|
боснийский|
валлийский|
венгерский|
вьетнамский|
гавайский|
галисийский|
греческий|
грузинский|
гуджарати|
датский|
зулу|
иврит|
игбо|
идиш|
индонезийский|
ирландский|
исландский|
испанский|
итальянский|
йоруба|
казахский|
каннада|
каталанский|
киргизский|
китайский|
корейский|
корсиканский|
креольский (Гаити)|
курманджи|
кхмерский|
кхоса|
лаосский|
латинский|
латышский|
литовский|
люксембургский|
македонский|
малагасийский|
малайский|
малаялам|
мальтийский|
маори|
маратхи|
монгольский|
немецкий|
непальский|
нидерландский|
норвежский|
панджаби|
персидский|
польский|
португальский|
пушту|
румынский|
русский|
самоанский|
себуанский|
сербский|
сесото|
сингальский|
синдхи|
словацкий|
словенский|
сомалийский|
суахили|
суданский|
таджикский|
тайский|
тамильский|
телугу|
турецкий|
узбекский|
украинский|
урду|
филиппинский|
финский|
французский|
фризский|
хауса|
хинди|
хмонг|
хорватский|
чева|
чешский|
шведский|
шона|
шотландский (гэльский)|
эсперанто|
эстонский|
яванский|
японский";
      $langs = explode('|', $langs);
      foreach ($langs as $langName) {
        $this->insert('{{%spoken_lang}}', []);
        $this->insert('{{%spoken_lang_lang}}', [
          'entity_id' => $this->db->getLastInsertID(),
          'lang_id' => 1,
          'name' => $langName
        ]);
      }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190215_185013_init_spoken_lang_table cannot be reverted.\n";

        return false;
    }
}
