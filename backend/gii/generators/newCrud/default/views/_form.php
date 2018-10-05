<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator backend\gii\generators\newCrud\Generator */
/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
  $safeAttributes = $model->attributes();
}
echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>



<?= "<?php " ?>$form = ActiveForm::begin(); ?>

<div class="m-portlet__head">
  <div class="m-portlet__head-caption">
    <?php echo '<?=' ?> CrudActions::widget(["model" => $model, "template" => "{index}"]) ?>
  </div>
  <div class="m-portlet__head-tools">
    <ul class="m-portlet__nav">
      <li class="m-portlet__nav-item">
        <?= '<?=' ?> CrudActions::widget(['model' => $model,]); ?>
      </li>
    </ul>
  </div>
</div>
<div class="m-portlet__body">

  <div class="row">
    <div class="col-xl-8 offset-xl-2">
<?php $atts = [];
      $counter = 1;
      $index = 0;
      foreach ($generator->getColumnNames() as $attribute) {
        if (in_array($attribute, $safeAttributes) && !in_array($attribute, ['created_at', 'updated_at'])) {
          $atts[$index][] = $attribute;
          if ($counter++ % 2 === 0) {
            $counter = 1;
            $index++;
          }
        }
      }
      foreach ($atts as $attGroup) : ?>
        <div class="row">
<?php foreach ($attGroup as $att) : ?>
          <div class="col-md-6">
<?php echo "        <?= " . $generator->generateActiveField($att) . " ?>" . PHP_EOL; ?>
          </div>
<?php endforeach; ?>
        </div>
<?php endforeach; ?>
    </div>
  </div>
</div>
<?= "<?php " ?>ActiveForm::end(); ?>

