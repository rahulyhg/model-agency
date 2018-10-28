<?php

/* @var $this yii\web\View */

$this->title = 'Доска объявлений';
$this->params['showSearchForm'] = true;
$this->params['showCategories'] = true;
?>
<!-- b-content -->
<div class="b-content b-main__content">
    <!-- b-recent-announcements -->
    <section class="b-recent-announcements b-content__item">
        <header class="b-recent-announcements__header">
            <h2 class="b-title b-recent-announcements__title">
                Последние объявления
            </h2>
        </header>

        <main class="b-recent-announcements__main">

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Велосипед горный">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/1.jpg"
                             alt="Велосипед горный">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Велосипед горный</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Спорт / Отдых » Вело</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="7599.00">7599</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Мужская рубашка">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/2.jpg"
                             alt="Мужская рубашка">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Мужская рубашка</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Одежда » Мужская
                        одежда</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="489.00">489</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Автомобиль Mazda">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/3.jpg"
                             alt="Автомобиль Mazda">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Автомобиль Mazda</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Транспорт » Легковые
                        автомобили</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                                        <span class="b-second-announcement__price" itemprop="price" content="84300.00">84
                                            300</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Веревка для сушки белья">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/4.jpg"
                             alt="Веревка для сушки белья">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Веревка для сушки
                            белья</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Дом / Сад »
                        Хозяйственный
                        инвентарь</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="65.00">65</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Автомобиль Mazda">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/3.jpg"
                             alt="Автомобиль Mazda">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Автомобиль Mazda</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Транспорт » Легковые
                        автомобили</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                                        <span class="b-second-announcement__price" itemprop="price" content="84300.00">84
                                            300</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Веревка для сушки белья">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/4.jpg"
                             alt="Веревка для сушки белья">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Веревка для сушки
                            белья</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Дом / Сад »
                        Хозяйственный
                        инвентарь</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="65.00">65</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Велосипед горный">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/1.jpg"
                             alt="Велосипед горный">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Велосипед горный</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Спорт / Отдых » Вело</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="7599.00">7599</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Мужская рубашка">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/2.jpg"
                             alt="Мужская рубашка">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Мужская рубашка</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Одежда » Мужская
                        одежда</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="489.00">489</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <?= Yii::$app->banner->get('home_inside_recent_ads') ?>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Велосипед горный">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/1.jpg"
                             alt="Велосипед горный">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Велосипед горный</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Спорт / Отдых » Вело</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="7599.00">7599</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Мужская рубашка">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/2.jpg"
                             alt="Мужская рубашка">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Мужская рубашка</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Одежда » Мужская
                        одежда</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="489.00">489</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Автомобиль Mazda">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/3.jpg"
                             alt="Автомобиль Mazda">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Автомобиль Mazda</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Транспорт » Легковые
                        автомобили</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                                        <span class="b-second-announcement__price" itemprop="price" content="84300.00">84
                                            300</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>

            <article class="b-second-announcement b-recent-announcements__item" itemscope itemtype="http://schema.org/Product">
                <header class="b-second-announcement__header">
                    <a class="b-second-announcement__img-link" href="single.html" title="Веревка для сушки белья">
                        <img class="b-second-announcement__img" itemprop="image" src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/recent-announcements/4.jpg"
                             alt="Веревка для сушки белья">
                    </a>
                </header>

                <main class="b-second-announcement__main">
                    <a class="b-second-announcement__title-link" href="single.html">
                        <h3 class="b-second-announcement__title" itemprop="name">Веревка для сушки
                            белья</h3>
                    </a>
                    <p class="b-second-announcement__category" itemprop="category">Дом / Сад »
                        Хозяйственный
                        инвентарь</p>

                    <p class="b-second-announcement__offer" itemprop="offers">
                        <span class="b-second-announcement__price" itemprop="price" content="65.00">65</span>
                        <span class="b-second-announcement__currency" itemprop="priceCurrency" content="UAH">грн</span>
                    </p>
                </main>

                <footer class="b-second-announcement__footer">
                                    <span class="b-second-announcement__location" title="Киев, Киевская область, Украина">
                                        <i class="b-second-announcement__icon pe-7s-map-marker"></i>
                                        Киев, Киевская об...
                                    </span>

                    <time class="b-second-announcement__date" datetime="2018-10-09">
                        <i class="b-second-announcement__icon pe-7s-clock"></i>
                        Вчера 18:34
                    </time>
                </footer>
            </article>
        </main>
    </section>
    <!-- b-recent-announcements -->
</div>
<!-- b-content end -->