<?php
/**
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel \modules\bulletin\widgets\search\models\SearchForm
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->params['showSearchForm'] = true;
?>

<!-- b-content -->
<div class="b-content b-main__content b-main__content_sidebar">

  <!-- b-category-announcemen -->
  <section class="b-category-announcemen b-content__item">
    <header class="b-category-announcemen__header">
      <div class="b-sorting b-category-announcemen__sorting">
        <div class="b-sorting__title">Сортировать:</div>

        <label class="b-field-select b-sorting__field-select">
          <select id="select-sort" data-select2-non-search class="b-select2 b-field-select__select2" onchange="location = this.value;">
            <?php
            $values = [
              '' => 'Рекомендованые',
              'price' => 'По цене: от дешевых к дорогим',
              '-price' => 'По цене: от дорогих к дешевым',
            ];
            $current = Yii::$app->request->get('sort');
            ?>
            <?php foreach ($values as $value => $label): ?>
              <option value="<?= Html::encode(Url::current(['sort' => $value ?: null])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
            <?php endforeach; ?>
          </select>
        </label>
      </div>
    </header>

    <main class="b-category-announcemen__main">
      <?php if(count($dataProvider->getModels()) > 0) : ?>
        <?php foreach($dataProvider->getModels() as $model) : ?>
          <?= $this->render('_card', ['model' => $model]) ?>
        <?php endforeach; ?>
      <?php else : ?>
        <p class="b-category-announcemen__not-found">Объявлений не найдено.</p>
      <?php endif; ?>
    </main>

    <footer class="b-category-announcemen__footer">
      <?= LinkPager::widget([
        'pagination' => $dataProvider->getPagination(),
      ]) ?>
    </footer>
  </section>
  <!-- b-category-announcemen end -->

</div>
<!-- b-content end -->

<!-- b-sidebar -->
<div class="b-sidebar b-main__sidebar">
  <?= Yii::$app->banner->get('category_sidebar') ?>
</div>
<!-- b-sidebar end -->
