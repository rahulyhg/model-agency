<?php
/**
 * @var $this View
 * @var $filterManager AttributeTypeFilterManager
 * @var $filterForm FilterForm
 * @var $category string
 */
use modules\bulletin\common\types\AttributeTypeFilterManager;
use modules\bulletin\frontend\forms\FilterForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
  'action' => ['/bulletin/default/category', 'id' => $category],
  'method' => 'get',
  'options' => [
    'id' => 'filters-form',
    'class' => 'b-filters b-header__filters'
  ]
]); ?>
<?php foreach($filterManager->generateFilterFields() as $fields) : ?>
  <div class="b-filters__col">
    <?php foreach($fields as $field) : ?>
      <?= $field ?>
    <?php endforeach ?>
  </div>
<?php endforeach; ?>

  <button type="submit" class="b-button-second b-filters__apply">
    <span class="b-button-second__value">Применить</span>
  </button>
<?php ActiveForm::end() ?>
<?php
$this->registerJs('
$("#filters-form").on("beforeSubmit", function (e) {
    var emptyinputs = $(this).find("input").filter(function(){
        return !$.trim(this.value).length;  // get all empty fields
    }).prop("disabled",true);
    console.log(emptyinputs);
    return true;
});
')
?>