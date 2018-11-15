<?php

use kartik\widgets\FileInput;
use modules\bulletin\common\models\Category;
use modules\client\common\models\Client;
use modules\location\common\models\Location;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\crudActions\CrudActions;

/* @var $this yii\web\View */
/* @var $model modules\bulletin\common\models\Bulletin */
/* @var $form yii\widgets\ActiveForm */
/* @var $attributeTypeManager modules\bulletin\common\types\AttributeTypeManager */

use modules\bulletin\Module;

$this->registerJs('
$(document).ready(function () {
    $(\'#rubric\').select2({
        \'placeholder\': "Выберите рубрику...",
        \'language\': {
            \'noResults\': function () {
                return "Такой рубрики не существует";
            }
        }
    });

    $(\'select\').on(\'select2:open\', function (e) {
        $(\'.select2-results__options\').scrollbar().parent().addClass(\'scrollbar-outer\');
        $(\'.select2-search input\').prop(\'focus\', false);
    });

    $(\'[data-select2-non-search]\').select2({
        \'minimumResultsForSearch\': -1
    });
    
    $(\'[data-select2-search]\').select2();
    
    $("#phone").mask("+38 (099) 999-9999");

    autosize(document.getElementById(\'description-input\'));
});
');
?>
<!-- b-content -->
<div class="b-content b-main__content">

  <!-- b-place-an-ad -->
  <?php $form = ActiveForm::begin([
    'options' => ['id' => 'bulletin-form']
  ]); ?>
  <section class="b-place-an-ad b-content__place-an-ad">
    <header class="b-place-an-ad__header">
      <h2 class="b-place-an-ad__title"><?= Module::t('adv-form', 'Подать обьявление - шаг 1') ?></h2>
    </header>

    <main class="b-place-an-ad__main">
      <p>
        <?= $form->errorSummary($model); ?>
      </p>
      <form class="b-place-an-ad__items">
        <div class="b-place-an-ad__goup">
          <label class="b-field b-field_characters b-place-an-ad__item">
            <span class="b-field-name b-field__name">Заголовок:</span>
            <?= $form->field($model, 'title')->label(false)->textInput([
              'autofocus' => true,
              'class' => 'b-field__input',
            ]) ?>
            <!--<span class="b-field__characters">
                <span class="b-field__characters-value" data-field-characters-value>255</span>
            </span>-->
          </label>

          <label class="b-field-select b-place-an-ad__item">
            <span class="b-field-name b-field-select__name">Рубрика:</span>
            <?= $form->field($model, 'category_id')->label(false)->widget(kartik\widgets\Select2::class, [
              'data' => Category::getMap(),
              'options' => [
                'placeholder' => '',
                'id' => 'rubric'
              ],
              'pluginOptions' => ['allowClear' => true],
              'pluginEvents' => [
                'change' => 'function() {
                if(this.value) {
                  $.post("' . Url::to(['attribute-fields', 'id' => $model->id, 'categoryId' => '']) . '"+this.value, function(data){
                    $("#attributes-container").html(data);
                  });
                } else {
                  $("#attributes-container").html("");
                }
              }'
              ]
            ]) ?>
          </label>

          <div id="attributes-container">
            <?php if (isset($attributeTypeManager)) : ?>
              <?= $this->render('_attributes', ['form' => $form, 'attributeTypeManager' => $attributeTypeManager]) ?>
            <?php endif; ?>
          </div>

          <label class="b-field-textarea b-field-textarea_characters b-place-an-ad__item" data-field-characters-item>
            <span class="b-field-name b-field-textarea__name">Описание:</span>
            <?= $form->field($model, 'content')->label(false)->textarea([
              'rows' => 10,
              'cols' => 30,
              'class' => 'b-field-textarea__input',
              'maxlength' => true,
              'minlength' => true,
              'data-field-characters-input',
              'id' => 'description-input'
            ]) ?>
            <!--<span class="b-field-textarea__characters">
                <span class="b-field-textarea__characters-value" data-field-characters-value>9000</span>
            </span>-->
          </label>

          <!--<div class="b-field-img b-place-an-ad__item">
            <span class="b-field-name b-field-img__name">Фотографии:</span>

            <ul class="b-field-img__items">
              <li class="b-field-img__item"
                  style="background-image: url('<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/3.jpg');"></li>
              <li class="b-field-img__item"
                  style="background-image: url('<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/3.jpg');"></li>
              <li class="b-field-img__item-empty"></li>
              <li class="b-field-img__item-empty"></li>
              <li class="b-field-img__item-empty"></li>
              <li class="b-field-img__item-empty"></li>
              <li class="b-field-img__item-empty"></li>
              <li class="b-field-img__item-empty"></li>
            </ul>
          </div>-->
          <?php
          $initialPreview = [];
          $initialPreviewConfig = [];
          if (!empty($model->bulletinImages)) {
            $initialPreview = \yii\helpers\ArrayHelper::getColumn($model->bulletinImages, 'imageUrl');
            foreach ($model->bulletinImages as $bulletinImage) {
              $initialPreviewConfig[] = ['caption' => $bulletinImage->imageCaption, 'size' => $bulletinImage->imageSize, 'key' => $bulletinImage->id];
            }
          }
          ?>
          <?= $form->field($galleryForm, 'images[]')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*', 'multiple' => true,],
            'pluginOptions' => [
              'fileActionSettings' => ['showZoom' => false],
              'deleteUrl' => Url::to(['delete-image']),
              'initialPreview' => $initialPreview,
              'initialPreviewAsData' => true,
              'initialPreviewConfig' => $initialPreviewConfig,
              'overwriteInitial' => false,
            ]
          ]); ?>
          <?php $this->registerJs('$(".input-group-btn.input-group-append").removeClass("input-group-btn");', $this::POS_LOAD); ?>
        </div>

        <div class="b-place-an-ad__goup b-place-an-ad__goup_darkened">
          <h3 class="b-place-an-ad__subtitle">Ваши контакты:</h3>

          <label class="b-field-select b-place-an-ad__item">
            <span class="b-field-name b-field-select__name">Страна:</span>
            <select class="b-select2 b-field-select__select2" data-select2-search disabled
                    name="country" required>
              <option value="1" selected>Украина</option>
            </select>
          </label>

          <label class="b-field-select b-place-an-ad__item">
            <span class="b-field-name b-field-select__name">Область:</span>
            <select class="b-select2 b-field-select__select2" data-select2-search name="region" required>
              <option value="1">Винницкая область</option>
              <option value="2">Волынская область</option>
              <option value="3">Днепропетровская область</option>
              <option value="4">Донецкая область</option>
              <option value="5">Житомирская область</option>
              <option value="6">Закарпатская область</option>
              <option value="7">Запорожская область</option>
              <option value="8">Ивано-Франковская область</option>
              <option value="9" selected>Киевская область</option>
              <option value="10">Кировоградская область</option>
              <option value="11">Крым (АРК)</option>
              <option value="12">Луганская область</option>
              <option value="13">Львовская область</option>
              <option value="14">Николаевская область</option>
              <option value="15">Одесская область</option>
              <option value="16">Полтавская область</option>
              <option value="17">Ровенская область</option>
              <option value="18">Сумская область</option>
              <option value="19">Тернопольская область</option>
              <option value="20">Харьковская область</option>
              <option value="21">Херсонская область</option>
              <option value="22">Хмельницкая область</option>
              <option value="23">Черкасская область</option>
              <option value="24">Черниговская область</option>
              <option value="25">Черновицкая область</option>
            </select>
          </label>

          <label class="b-field-select b-place-an-ad__item">
            <span class="b-field-name b-field-select__name">Город:</span>
            <select class="b-select2 b-field-select__select2" data-select2-search name="sity" required>
              <option value="9.19">Киев</option>
              <option value="9.1">Барышевка</option>
              <option value="9.2">Белая Церковь</option>
              <option value="9.3">Березань</option>
              <option value="9.4">Богуслав</option>
              <option value="9.5">Борисполь</option>
              <option value="9.6">Бородянка</option>
              <option value="9.7">Боярка</option>
              <option value="9.8">Бровары</option>
              <option value="9.9">Буча</option>
              <option value="9.10">Васильков</option>
              <option value="9.11">Вишневое</option>
              <option value="9.12">Володарка</option>
              <option value="9.13">Вышгород</option>
              <option value="9.14">Глеваха</option>
              <option value="9.15">Гостомель</option>
              <option value="9.16">Иванков</option>
              <option value="9.17">Ирпень</option>
              <option value="9.18">Кагарлык</option>
              <option value="9.20">Коцюбинское</option>
              <option value="9.21">Макаров</option>
              <option value="9.22">Мироновка</option>
              <option value="9.23">Обухов</option>
              <option value="9.24">Переяслав-Хмельницкий</option>
              <option value="9.25">Припять</option>
              <option value="9.26">Ржищев</option>
              <option value="9.27">Рокитное</option>
              <option value="9.28">Сквира</option>
              <option value="9.29">Славутич</option>
              <option value="9.30">Тараща</option>
              <option value="9.31">Тетиев</option>
              <option value="9.32">Узин</option>
              <option value="9.33">Украинка</option>
              <option value="9.34">Фастов</option>
              <option value="9.35">Чернобыль</option>
              <option value="9.36">Яготин</option>
            </select>
          </label>

          <label class="b-field b-field_characters b-place-an-ad__item">
            <span class="b-field-name b-field__name">Email:</span>

            <input class="b-field__input" disabled value="ivanov.ivan@gmail.com" type="email"
                   name="email" required>
          </label>

          <label class="b-field b-field_characters b-place-an-ad__item">
            <span class="b-field-name b-field__name">Контактное лицо:</span>

            <input class="b-field__input" disabled value="<?= Yii::$app->user->identity->name ?>" type="text" name="title" required>
          </label>

          <!-- <button type="submit" class="b-button-second b-place-an-ad__next">
              <span class="b-button-second__value">Далее</span>
          </button> -->
          <button type="submit" class="b-button-second b-place-an-ad__next">
            <span class="b-button-second__value">Далее</span>
          </button>
        </div>
      </form>
    </main>
  </section>
  <?php ActiveForm::end(); ?>
  <!-- b-place-an-ad end -->

</div>
<!-- b-content end -->