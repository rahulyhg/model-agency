<?php
/**
 * @var $this \yii\web\View
 */
$this->registerJs('
$(document).ready(function() {
    new Promotions({
        \'items\': \'.b-promotion__substitution-select input\',
        \'totalValue\': \'.b-promotions__total-value\',
        \'payment\': \'.b-button-second\',
        \'paymentClassAnim\': \'b-button-second_animation\'
    })
})
');
?>
<!-- b-content -->
<div class="b-content b-main__content">

  <!-- b-place-an-ad -->
  <section class="b-place-an-ad b-content__place-an-ad">
    <header class="b-place-an-ad__header">
      <h2 class="b-place-an-ad__title">Подать обьявление - шаг 2</h2>
      <h3 class="b-place-an-ad__subtitle">Запустите рекламу, что бы получить больше кликов</h3>
    </header>

    <main class="b-place-an-ad__main">
      <form class="b-promotions b-place-an-ad__promotions" action="publication">
        <ul class="b-promotions__items">

          <li class="b-promotion b-promotions__item">
            <h2 class="b-promotion__title">Легкий старт</h2>

            <ul class="b-promotion__list">
              <li class="b-promotion__list-item">- Топ-объявление на 3 дня</li>
              <li class="b-promotion__list-item b-promotion__list-item_disable">-
                Поднятие вверх списка</li>
              <li class="b-promotion__list-item b-promotion__list-item_disable">-
                VIP-объявление</li>
            </ul>

            <p class="b-promotion__price">35грн</p>

            <label class="b-substitution-select b-promotion__substitution-select">
              <input class="b-substitution-select__input" required value="1" name="service" type="radio"
                     data-promotion-price="35 грн">

              <span class="b-button-first b-substitution-select__not-selected">
                                                <span class="b-button-first__value">Выбрать</span>
                                            </span>

              <span class="b-button-success b-substitution-select__selected">
                                                <span class="b-button-success__value">Выбрано</span>
                                            </span>
            </label>
          </li>

          <li class="b-promotion b-promotions__item">
            <h2 class="b-promotion__title">Быстрая продажа</h2>

            <ul class="b-promotion__list">
              <li class="b-promotion__list-item">- Топ-объявление на 3 дня</li>
              <li class="b-promotion__list-item">- Поднятие вверх списка</li>
              <li class="b-promotion__list-item b-promotion__list-item_disable">-
                VIP-объявление</li>
            </ul>

            <p class="b-promotion__price">65грн</p>

            <label class="b-substitution-select b-promotion__substitution-select">
              <input class="b-substitution-select__input" required value="2" name="service" type="radio"
                     data-promotion-price="65 грн">

              <span class="b-button-first b-substitution-select__not-selected">
                                                <span class="b-button-first__value">Выбрать</span>
                                            </span>

              <span class="b-button-success b-substitution-select__selected">
                                                <span class="b-button-success__value">Выбрано</span>
                                            </span>
            </label>
          </li>

          <li class="b-promotion b-promotions__item">
            <h2 class="b-promotion__title">Турбо-продажа</h2>

            <ul class="b-promotion__list">
              <li class="b-promotion__list-item">- Топ-объявление на 3 дня</li>
              <li class="b-promotion__list-item">- Поднятие вверх списка</li>
              <li class="b-promotion__list-item">- VIP-объявление</li>
            </ul>

            <p class="b-promotion__price">95грн</p>

            <label class="b-substitution-select b-promotion__substitution-select">
              <input class="b-substitution-select__input" required value="3" name="service" type="radio"
                     data-promotion-price="95 грн">

              <span class="b-button-first b-substitution-select__not-selected">
                                                <span class="b-button-first__value">Выбрать</span>
                                            </span>

              <span class="b-button-success b-substitution-select__selected">
                                                <span class="b-button-success__value">Выбрано</span>
                                            </span>
            </label>
          </li>
        </ul>

        <div class="b-promotions__total">Всего к оплате:
          <span class="b-promotions__total-value">0 грн</span>
        </div>

        <div class="b-promotions__actions">
          <a class="b-button-empty b-promotions__actions-item" href="<?= \yii\helpers\Url::to(['/bulletin/create/step3']) ?>">
            <span class="b-button-empty__value b-button-empty__value_bold">Не рекламировать</span>
          </a>

          <button type="submit" class="b-button-second b-promotions__actions-item">
            <span class="b-button-second__value b-button-second__value_bold">Оплатить</span>
          </button>
        </div>
      </form>
    </main>
  </section>
  <!-- b-place-an-ad -->

</div>
<!-- b-content end -->