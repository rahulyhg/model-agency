<?php
/**
 * @var $attributeTypeManager modules\bulletin\common\types\AttributeTypeManager
 * @var $form yii\widgets\ActiveForm
 * @var $this yii\web\View
 * @var $registerJs boolean|null
 */
?>
<div>
  <?php foreach($attributeTypeManager->generateValueFields($form) as $field): ?>
    <div class="attribute-box">
      <?= $field ?>
    </div>
  <?php endforeach; ?>
</div>
<?php if($registerJs === true) {
  $attributes = \yii\helpers\Json::htmlEncode($form->attributes);
  $js = <<<JS
var attributes = $attributes;
var form = $("#{$form->options['id']}");
for(var i = 0; i < attributes.length; i++){
  form.yiiActiveForm("add", attributes[i]);
}
JS;
  $this->registerJs($js);
}