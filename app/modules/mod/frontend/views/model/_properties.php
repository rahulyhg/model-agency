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
      'value' => $model->full_name,
      'label' => 'Имя'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->height,
      'label' => 'Рост'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->weight,
      'label' => 'Вес'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->bust,
      'label' => 'Бюст'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->waist,
      'label' => 'Талия'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->hips,
      'label' => 'Бедра'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->eyesColor->color,
      'label' => 'Цвет глаз'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->hairColor->color->color,
      'label' => 'Цвет волос'
    ]) ?>
    <?= $this->render('_property', [
      'value' => $model->shoes,
      'label' => 'Размер ноги'
    ]) ?>

    <li class="b-features__item-title"><span class="b-features__title">Languages:<span class="b-features__title-line b-features__title-line_delay-9"></span></span></li>
    <li class="b-features__item-value"><span class="b-features__value">english</span></li>
  </ul>
</div>
