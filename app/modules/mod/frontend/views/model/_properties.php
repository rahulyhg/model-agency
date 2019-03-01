<?php
/**
 * @var $this \yii\web\View
 * @var $model \modules\mod\common\models\Mod
 * @var $elementClass string
 */
?>
<div class="b-features <?= $elementClass ?>">
  <ul class="b-features__items">
    <?= $this->render('_property', [
      'value' => $model->full_name ?: '-',
      'label' => 'Имя'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->age ?: '-',
      'label' => 'Возраст'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->height ?: '-',
      'label' => 'Рост'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->weight ?: '-',
      'label' => 'Вес'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->bust ?: '-',
      'label' => 'Размер груди'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->waist ?: '-',
      'label' => 'Обхват талии'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->hips ?: '-',
      'label' => 'Обхват бедер'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->eyesColor->color ?: '-',
      'label' => 'Цвет глаз'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->hairColor->color ?: '-',
      'label' => 'Цвет волос'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->shoes ?: '-',
      'label' => 'Размер ноги'
    ]) ?>
    <?php
    $spokenLangs = [];
    foreach ($model->modSpokenLangs as $spokenLang) {
      $spokenLangs[] = $spokenLang->spokenLang->name;
    }
    $langsStr = implode(', ', $spokenLangs) ?>
    <?= $this->render('_property', [
      'value' => $langsStr,
      'label' => 'Языки'
    ]) ?>
  </ul>
</div>
