<?php
/**
 * @var $this \yii\web\View
 */
?>
<footer class="b-footer b-page__footer">
    <div class="b-footer__inner">
        <div class="b-footer__row">
            <a class="b-logo b-footer__logo" href="<?= \yii\helpers\Url::to(['/']) ?>">
                <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/logo-monophonic.png" alt="ADV Board - Доска обьявлений" class="b-logo__img">
            </a>

            <ul class="b-menu-first b-footer__menu-first">
                <li class="b-menu-first__item">
                    <a href="#" class="b-menu-first__item-link">Мобильные приложения</a>
                </li>
                <li class="b-menu-first__item">
                    <a href="#" class="b-menu-first__item-link">Помощь и Обратная связь</a>
                </li>
                <li class="b-menu-first__item">
                    <a href="#" class="b-menu-first__item-link">Для прессы</a>
                </li>
                <li class="b-menu-first__item">
                    <a href="#" class="b-menu-first__item-link">Реклама на сайте</a>
                </li>
                <li class="b-menu-first__item">
                    <a href="#" class="b-menu-first__item-link">Блог ADV Board</a>
                </li>
                <li class="b-menu-first__item">
                    <a href="#" class="b-menu-first__item-link">Условия использования</a>
                </li>

            </ul>

            <ul class="b-menu-second b-footer__menu-second">
                <li class="b-menu-second__item">
                    <a href="#" class="b-menu-second__item-link">Как продавать и покупать?</a>
                </li>
                <li class="b-menu-second__item">
                    <a href="#" class="b-menu-second__item-link">Правила безопасности</a>
                </li>
                <li class="b-menu-second__item">
                    <a href="#" class="b-menu-second__item-link">Карта сайта</a>
                </li>
                <li class="b-menu-second__item">
                    <a href="#" class="b-menu-second__item-link">Карта регионов</a>
                </li>
            </ul>

            <?= Yii::$app->banner->get('footer_right') ?>
        </div>
    </div>
</footer>
