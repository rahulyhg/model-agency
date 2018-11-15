<?php
/**
 * @var $this \yii\web\View
 * @var $elementClass string
 * @var $topLevelCategories \modules\bulletin\common\models\Category[]
 */
?>
<ul class="b-categories <?= $elementClass ?>">
  <li class="b-blackout-page b-categories__blackout-page"></li>
  <?php foreach ($topLevelCategories as $category) :
    $childCategories = $category->getChildCategories(); ?>
    <li class="b-category b-categories__category">
      <a class="b-category__link" href="<?= count($childCategories) > 0 ? 'javascript:void(0)' : \yii\helpers\Url::to(['/bulletin/default/category', 'id' => $category->id]) ?>">
        <div class="b-category__img-wrp">
          <img src="<?= $category->iconUrl ?>" alt="<?= $category->name ?>"
               class="b-category__img">
        </div>

        <div class="b-category__name"><?= $category->name ?></div>
      </a>
      <?php if(count($childCategories) > 0) : ?>
        <ul class="b-subcategories b-category__subcategories">
          <li class="b-subcategories__current">
            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
            <a class="b-subcategories__current-link" href="<?= \yii\helpers\Url::to(['/bulletin/default/category', 'id' => $category->id]) ?>">
              Показать все объявления в категории
              <span class="b-subcategories__current-name"><?= $category->name ?></span>
            </a>
          </li>
          <li class="b-subcategories__arrow"></li>
          <ul class="b-subcategories__other">

            <?php foreach ($childCategories as $childCategory) : ?>
              <li class="b-subcategory b-subcategories__subcategory">
                <a class="b-subcategory__link" href="<?= \yii\helpers\Url::to(['/bulletin/default/category', 'id' => $childCategory->id]) ?>">
                  <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                  <span class="b-subcategory__name" title="name"><?= $childCategory->name ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </ul>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ul>
