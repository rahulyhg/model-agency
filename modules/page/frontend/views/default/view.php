<?php
/**
 * @var $this \yii\web\View
 * @var $model \modules\page\common\models\Page
 */
$this->title = $model->seo_title;
$this->params['meta_description'] = $model->seo_description;
$this->params['breadcrumbs'][] = $model->title;
?>
<a class="b-place-for-ads b-main__place-for-ads b-main__place-for-ads_sm" href="#" title="Рекламное объявление">
    <div class="b-place-for-ads__text">Баннер</div>

    <div class="b-place-for-ads__size">570 Х 140</div>
</a>

<a class="b-place-for-ads b-main__place-for-ads b-main__place-for-ads_lg" href="#" title="Рекламное объявление">
    <div class="b-place-for-ads__text">Баннер</div>

    <div class="b-place-for-ads__size">770 Х 140</div>
</a>

<!-- b-content -->
<div class="b-content b-main__content b-main__content_sidebar">

    <!-- b-single-announcemen -->
    <section class="b-single-announcement b-content__item">
        <header class="b-single-announcemen__header">
            <div class="b-single-announcemen__header-inner" style="padding-top: 1.5rem;">
                <h2 class="b-single-announcemen__title"><?= $model->title ?></h2>
            </div>
        </header>
        <main class="b-single-announcemen__main">
            <?= $model->content ?>
        </main>
    </section>
    <!-- b-single-announcemen end -->

    <a class="b-place-for-ads b-content__place-for-ads" href="#" title="Рекламное объявление">
        <div class="b-place-for-ads__text">Баннер</div>

        <div class="b-place-for-ads__size">870 Х 140</div>
    </a>

    <a class="b-place-for-ads b-content__place-for-ads" href="#" title="Рекламное объявление">
        <div class="b-place-for-ads__text">Баннер</div>

        <div class="b-place-for-ads__size">870 Х 140</div>
    </a>
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