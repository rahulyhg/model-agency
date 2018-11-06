<?php
/**
 * @var $this \yii\web\View
 * @var $elementClass string
 */
?>
<div class="b-my-ads <?= $elementClass ?>">
  <ul class="b-my-ads__toggle-tabs">
    <li class="b-my-ads__toggle-tab">
      <a class="b-my-ads__toggle-tab-link" href="#activeAds">Активные</a>
    </li>

    <li class="b-my-ads__toggle-tab">
      <a class="b-my-ads__toggle-tab-link" href="#notActiveAds">Не активные</a>
    </li>
  </ul>
  <ul class="b-my-ads__body-tabs">
    <li id="activeAds" class="b-my-ads__body-tab">

      <div class="b-my-ads__items">
        <article class="b-first-announcement b-my-ads__item" itemscope
                 itemtype="http://schema.org/Product">
          <header class="b-first-announcement__header">
            <a class="b-first-announcement__img-link" href="single.html"
               title="Автомобиль Mazda">
              <img class="b-first-announcement__img" itemprop="image"
                   src="./assets/img/tmp/recent-announcements/3.jpg"
                   alt="Автомобиль Mazda">
            </a>
          </header>

          <main class="b-first-announcement__main">
            <div class="b-first-announcement__top">
              <a class="b-first-announcement__title-link" href="single.html">
                <h3 class="b-first-announcement__title" itemprop="name">Автомобиль
                  Mazda</h3>
              </a>


              <p class="b-first-announcement__offer" itemprop="offers">
                                                                    <span class="b-first-announcement__price" itemprop="price"
                                                                          content="84300.00">84
                                                                        300</span>
                <span class="b-first-announcement__currency"
                      itemprop="priceCurrency" content="UAH">грн</span>
              </p>
            </div>

            <p class="b-first-announcement__category">
              <span class="b-first-announcement__category-item">Транспорт</span>
              <span class="b-first-announcement__category-item"
                    itemprop="category">Легковые
                                                                    автомобили</span>
            </p>

            <div class="b-first-announcement__bottom">
                                                                <span class="b-first-announcement__location" title="Киев, Киевская область, Украина">
                                                                    <i class="b-first-announcement__icon pe-7s-map-marker"></i>
                                                                    Киев, Киевская область
                                                                </span>

              <time class="b-first-announcement__date" datetime="2018-10-09">
                <i class="b-first-announcement__icon pe-7s-clock"></i>
                Вчера 18:34
              </time>
            </div>
          </main>

          <footer class="b-first-announcement__footer">
            <div class="b-first-announcement__footer-left">
              <div class="b-first-announcement__views">
                Просмотров:
                <span class="b-first-announcement__views-value">212</span>
              </div>
            </div>

            <div class="b-first-announcement__footer-right">
              <ul class="b-first-announcement__actions">
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Просмотреть
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Редактировать
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Поднять
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Выделить
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_danger">
                    Деактивировать
                  </a>
                </li>
              </ul>
            </div>
          </footer>
        </article>

        <article class="b-first-announcement b-my-ads__item" itemscope
                 itemtype="http://schema.org/Product">
          <header class="b-first-announcement__header">
            <a class="b-first-announcement__img-link" href="single.html"
               title="Автомобиль Mazda">
              <img class="b-first-announcement__img" itemprop="image"
                   src="./assets/img/tmp/recent-announcements/3.jpg"
                   alt="Автомобиль Mazda">
            </a>
          </header>

          <main class="b-first-announcement__main">
            <div class="b-first-announcement__top">
              <a class="b-first-announcement__title-link" href="single.html">
                <h3 class="b-first-announcement__title" itemprop="name">Автомобиль
                  Mazda</h3>
              </a>


              <p class="b-first-announcement__offer" itemprop="offers">
                                                                    <span class="b-first-announcement__price" itemprop="price"
                                                                          content="84300.00">84
                                                                        300</span>
                <span class="b-first-announcement__currency"
                      itemprop="priceCurrency" content="UAH">грн</span>
              </p>
            </div>

            <p class="b-first-announcement__category">
              <span class="b-first-announcement__category-item">Транспорт</span>
              <span class="b-first-announcement__category-item"
                    itemprop="category">Легковые
                                                                    автомобили</span>
            </p>

            <div class="b-first-announcement__bottom">
                                                                <span class="b-first-announcement__location" title="Киев, Киевская область, Украина">
                                                                    <i class="b-first-announcement__icon pe-7s-map-marker"></i>
                                                                    Киев, Киевская область
                                                                </span>

              <time class="b-first-announcement__date" datetime="2018-10-09">
                <i class="b-first-announcement__icon pe-7s-clock"></i>
                Вчера 18:34
              </time>
            </div>
          </main>

          <footer class="b-first-announcement__footer">
            <div class="b-first-announcement__footer-left">
              <div class="b-first-announcement__views">
                Просмотров:
                <span class="b-first-announcement__views-value">212</span>
              </div>
            </div>

            <div class="b-first-announcement__footer-right">
              <ul class="b-first-announcement__actions">
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Просмотреть
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Редактировать
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Поднять
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Выделить
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_danger">
                    Деактивировать
                  </a>
                </li>
              </ul>
            </div>
          </footer>
        </article>

        <article class="b-first-announcement b-my-ads__item" itemscope
                 itemtype="http://schema.org/Product">
          <header class="b-first-announcement__header">
            <a class="b-first-announcement__img-link" href="single.html"
               title="Автомобиль Mazda">
              <img class="b-first-announcement__img" itemprop="image"
                   src="./assets/img/tmp/recent-announcements/3.jpg"
                   alt="Автомобиль Mazda">
            </a>
          </header>

          <main class="b-first-announcement__main">
            <div class="b-first-announcement__top">
              <a class="b-first-announcement__title-link" href="single.html">
                <h3 class="b-first-announcement__title" itemprop="name">Автомобиль
                  Mazda</h3>
              </a>


              <p class="b-first-announcement__offer" itemprop="offers">
                                                                    <span class="b-first-announcement__price" itemprop="price"
                                                                          content="84300.00">84
                                                                        300</span>
                <span class="b-first-announcement__currency"
                      itemprop="priceCurrency" content="UAH">грн</span>
              </p>
            </div>

            <p class="b-first-announcement__category">
              <span class="b-first-announcement__category-item">Транспорт</span>
              <span class="b-first-announcement__category-item"
                    itemprop="category">Легковые
                                                                    автомобили</span>
            </p>

            <div class="b-first-announcement__bottom">
                                                                <span class="b-first-announcement__location" title="Киев, Киевская область, Украина">
                                                                    <i class="b-first-announcement__icon pe-7s-map-marker"></i>
                                                                    Киев, Киевская область
                                                                </span>

              <time class="b-first-announcement__date" datetime="2018-10-09">
                <i class="b-first-announcement__icon pe-7s-clock"></i>
                Вчера 18:34
              </time>
            </div>
          </main>

          <footer class="b-first-announcement__footer">
            <div class="b-first-announcement__footer-left">
              <div class="b-first-announcement__views">
                Просмотров:
                <span class="b-first-announcement__views-value">212</span>
              </div>
            </div>

            <div class="b-first-announcement__footer-right">
              <ul class="b-first-announcement__actions">
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Просмотреть
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Редактировать
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Поднять
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Выделить
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_danger">
                    Деактивировать
                  </a>
                </li>
              </ul>
            </div>
          </footer>
        </article>

        <article class="b-first-announcement b-my-ads__item" itemscope
                 itemtype="http://schema.org/Product">
          <header class="b-first-announcement__header">
            <a class="b-first-announcement__img-link" href="single.html"
               title="Автомобиль Mazda">
              <img class="b-first-announcement__img" itemprop="image"
                   src="./assets/img/tmp/recent-announcements/3.jpg"
                   alt="Автомобиль Mazda">
            </a>
          </header>

          <main class="b-first-announcement__main">
            <div class="b-first-announcement__top">
              <a class="b-first-announcement__title-link" href="single.html">
                <h3 class="b-first-announcement__title" itemprop="name">Автомобиль
                  Mazda</h3>
              </a>


              <p class="b-first-announcement__offer" itemprop="offers">
                                                                    <span class="b-first-announcement__price" itemprop="price"
                                                                          content="84300.00">84
                                                                        300</span>
                <span class="b-first-announcement__currency"
                      itemprop="priceCurrency" content="UAH">грн</span>
              </p>
            </div>

            <p class="b-first-announcement__category">
              <span class="b-first-announcement__category-item">Транспорт</span>
              <span class="b-first-announcement__category-item"
                    itemprop="category">Легковые
                                                                    автомобили</span>
            </p>

            <div class="b-first-announcement__bottom">
                                                                <span class="b-first-announcement__location" title="Киев, Киевская область, Украина">
                                                                    <i class="b-first-announcement__icon pe-7s-map-marker"></i>
                                                                    Киев, Киевская область
                                                                </span>

              <time class="b-first-announcement__date" datetime="2018-10-09">
                <i class="b-first-announcement__icon pe-7s-clock"></i>
                Вчера 18:34
              </time>
            </div>
          </main>

          <footer class="b-first-announcement__footer">
            <div class="b-first-announcement__footer-left">
              <div class="b-first-announcement__views">
                Просмотров:
                <span class="b-first-announcement__views-value">212</span>
              </div>
            </div>

            <div class="b-first-announcement__footer-right">
              <ul class="b-first-announcement__actions">
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Просмотреть
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Редактировать
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Поднять
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Выделить
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_danger">
                    Деактивировать
                  </a>
                </li>
              </ul>
            </div>
          </footer>
        </article>
      </div>
    </li>

    <li id="notActiveAds" class="b-my-ads__body-tab">
      <div class="b-my-ads__items">
        <article class="b-first-announcement b-my-ads__item" itemscope
                 itemtype="http://schema.org/Product">
          <header class="b-first-announcement__header">
            <a class="b-first-announcement__img-link" href="single.html"
               title="Автомобиль Mazda">
              <img class="b-first-announcement__img" itemprop="image"
                   src="./assets/img/tmp/recent-announcements/3.jpg"
                   alt="Автомобиль Mazda">
            </a>
          </header>

          <main class="b-first-announcement__main">
            <div class="b-first-announcement__top">
              <a class="b-first-announcement__title-link" href="single.html">
                <h3 class="b-first-announcement__title" itemprop="name">Автомобиль
                  Mazda</h3>
              </a>


              <p class="b-first-announcement__offer" itemprop="offers">
                                                                    <span class="b-first-announcement__price" itemprop="price"
                                                                          content="84300.00">84
                                                                        300</span>
                <span class="b-first-announcement__currency"
                      itemprop="priceCurrency" content="UAH">грн</span>
              </p>
            </div>

            <p class="b-first-announcement__category">
              <span class="b-first-announcement__category-item">Транспорт</span>
              <span class="b-first-announcement__category-item"
                    itemprop="category">Легковые
                                                                    автомобили</span>
            </p>

            <div class="b-first-announcement__bottom">
                                                                <span class="b-first-announcement__location" title="Киев, Киевская область, Украина">
                                                                    <i class="b-first-announcement__icon pe-7s-map-marker"></i>
                                                                    Киев, Киевская область
                                                                </span>

              <time class="b-first-announcement__date" datetime="2018-10-09">
                <i class="b-first-announcement__icon pe-7s-clock"></i>
                Вчера 18:34
              </time>
            </div>
          </main>

          <footer class="b-first-announcement__footer">
            <div class="b-first-announcement__footer-left">
              <div class="b-first-announcement__views">
                Просмотров:
                <span class="b-first-announcement__views-value">212</span>
              </div>
            </div>

            <div class="b-first-announcement__footer-right">
              <ul class="b-first-announcement__actions">
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Просмотреть
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_second">
                    Редактировать
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Поднять
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_first">
                    Выделить
                  </a>
                </li>
                <li class="b-first-announcement__actions-item">
                  <a href="#" class="b-first-announcement__actions-link b-first-announcement__actions-link_success">
                    Активировать
                  </a>
                </li>
              </ul>
            </div>
          </footer>
        </article>
      </div>
    </li>
  </ul>
</div>
