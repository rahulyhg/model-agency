<?php
/**
 * @var $this yii\web\View
 * @var $filterForm
 * @var $filterManager
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $category modules\bulletin\common\models\Category
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->params['showSearchForm'] = true;
foreach($category->parents as $parent){
  $this->params['breadcrumbs'][] = '<span class="b-bread-crumbs__item-name">'.$parent->name.'</span>';
}
$this->params['breadcrumbs'][] = '<span class="b-bread-crumbs__item-name">'.$category->name.'</span>';
$this->params['filterForm'] = $this->render('_filterform', ['filterForm' => $filterForm, 'category' => $category->id, 'filterManager' => $filterManager]);
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
      <?php foreach($dataProvider->getModels() as $model) : ?>
        <?= $this->render('_card', ['model' => $model]) ?>
      <?php endforeach ?>
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
  <a class="b-place-for-ads b-sidebar__place-for-ads" href="#" title="Рекламное объявление">
    <div class="b-place-for-ads__text">Баннер</div>

    <div class="b-place-for-ads__size">270 Х 475</div>
  </a>

  <a class="b-place-for-ads b-sidebar__place-for-ads" href="#" title="Рекламное объявление">
    <div class="b-place-for-ads__text">Баннер</div>

    <div class="b-place-for-ads__size">270 Х 475</div>
  </a>
</div>
<!-- b-sidebar end -->