<?php
/**
 * @var $this \yii\web\View
 */

use frontend\widgets\Breadcrumbs;
use \yii\helpers\Url;

if(isset($this->params['showSearchForm'])) {
    $this->registerJs('
        $(document).ready(function () {
            $(\'#search-location\').select2({
                "searchInputPlaceholder": \'Введите название населенного пункта\',
                "language": {
                    "noResults": function () {
                        return "Ничего не найдено";
                    }
                }
            });
        
            $(\'select\').on(\'select2:open\', function (e) {
                $(\'.select2-results__options\').scrollbar().parent().addClass(\'scrollbar-outer\');
                $(\'.select2-search input\').prop(\'focus\', false);
            });
        
            $(\'[data-select2-non-search]\').select2({
                "minimumResultsForSearch": -1
            });
            
            $(\'[data-select2-search]\').select2();
        
            $(\'.b-form-group__items\').scrollbar();
        });
    ');
}
if(isset($this->params['showCategories'])) {
    $this->registerJs('
        $(document).ready(function() {
            new ShowSubcategories({
                \'category\': \'.b-category\',
                \'categoryModificator\': \'b-category_view-subcategory\',
                \'categoryLink\': \'.b-category__link\',
                \'categorySubcategories\': \'.b-category__subcategories\',
                \'subcategoriesArrow\': \'.b-subcategories__arrow\',
                \'blackoutPage\': \'.b-blackout-page\',
                \'blackoutPageModificator\': \'b-blackout-page_show\'
            })
        })
    ');
}
?>
<header class="b-header b-page__header">
    <div class="b-header__first">
        <div class="b-header__first-inner">
            <div class="b-header__first-row">
                <div class="b-header__first-left">
                    <a class="b-logo b-header__logo" href="<?= \yii\helpers\Url::to(['/']) ?>">
                        <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/logo.png" alt="ADV Board" class="b-logo__img">
                    </a>
                </div>

                <div class="b-multilanguage b-header__multilanguage">
                    <a class="b-multilanguage__item b-multilanguage__item_active" href="javascript:void(0)"
                       title="Сайт уже на Русском языке!">Язык</a>
                    <a class="b-multilanguage__item" href="index.html" title="Натисніть для переходу на Україньську мову!">Мова</a>
                </div>

                <div class="b-header__first-right">
                    <div class="b-user b-header__user">
                        <div class="b-user__name">Иван Васильевич</div>

                        <span class="b-user__drop-arrow">
                                    <i class="b-user__drop-arrow-up pe-7s-angle-up"></i>
                                    <i class="b-user__drop-arrow-down pe-7s-angle-down"></i>
                                </span>

                        <ul class="b-drop-list b-user__drop-list">
                            <li class="b-drop-list__item">
                                <a href="<?= Url::to(['/client/profile/index']) ?>#myProfile" class="b-drop-list__item-link">Мой профиль</a>
                            </li>

                            <li class="b-drop-list__item">
                                <a href="<?= Url::to(['/client/profile/index']) ?>#myAds" class="b-drop-list__item-link">Мои обьявления</a>
                            </li>

                            <li class="b-drop-list__item">
                                <a href="<?= Url::to(['/client/profile/index']) ?>#myPay" class="b-drop-list__item-link">Мои платежи</a>
                            </li>

                            <li class="b-drop-list__item">
                                <a href="#" class="b-drop-list__item-link">Выйти</a>
                            </li>
                        </ul>
                    </div>

                    <a href="place-an-ad-1.html" class="b-button-first b-header__button-first">
                                <span class="b-button-first__icon-wrp">
                                    <i class="b-button-first__icon pe-7s-plus"></i>
                                </span>

                        <span class="b-button-first__value">Подать обьявление</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($this->params['showSearchForm']) || isset($this->params['showCategories']) || isset($this->params['breadcrumbs'])) : ?>
    <div class="b-header__second">
        <div class="b-header__second-inner">
            <?php if(isset($this->params['breadcrumbs'])) : ?>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            <?php endif; ?>
            <?php if($this->params['showSearchForm']) : ?>
            <form action="search" class="b-search b-header__search">
                <label for="search-inquiry" class="b-field b-search__field">
                    <input type="text" name="search-inquiry" placeholder="Поиск по фразам" autocomplete="off"
                           class="b-field__input">
                </label>

                <label class="b-field-select b-search__field-select">

                    <select id="search-location" class="b-field-select__select2" for="search-location" name="state">
                        <option selected value="0">Вся Украина</option>

                        <option value="1">Винницкая область, Украина</option>
                        <option value="1.3">Винница, Винницкая область, Украина</option>
                        <option value="1.1">Бар, Винницкая область, Украина</option>
                        <option value="1.2">Бершадь, Винницкая область, Украина</option>
                        <!-- <option value="1.3">Винница, Винницкая область, Украина</option> -->
                        <option value="1.4">Гайсин, Винницкая область, Украина</option>
                        <option value="1.5">Гнивань, Винницкая область, Украина</option>
                        <option value="1.6">Жмеринка, Винницкая область, Украина</option>
                        <option value="1.7">Ильинцы, Винницкая область, Украина</option>
                        <option value="1.8">Казатин, Винницкая область, Украина</option>
                        <option value="1.9">Калиновка, Винницкая область, Украина</option>
                        <option value="1.10">Крыжополь, Винницкая область, Украина</option>
                        <option value="1.11">Ладыжин, Винницкая область, Украина</option>
                        <option value="1.12">Липовец, Винницкая область, Украина</option>
                        <option value="1.13">Могилев-Подольский, Винницкая область, Украина</option>
                        <option value="1.14">Немиров, Винницкая область, Украина</option>
                        <option value="1.15">Песочин, Винницкая область, Украина</option>
                        <option value="1.16">Погребище, Винницкая область, Украина</option>
                        <option value="1.17">Стрижавка, Винницкая область, Украина</option>
                        <option value="1.18">Тульчин, Винницкая область, Украина</option>
                        <option value="1.19">Хмельник, Винницкая область, Украина</option>
                        <option value="1.20">Чечельник, Винницкая область, Украина</option>
                        <option value="1.21">Шаргород, Винницкая область, Украина</option>
                        <option value="1.22">Ямполь, Винницкая область, Украина</option>

                        <option value="2">Волынская область, Украина</option>
                        <option value="2.1">Берестечко, Волынская область, Украина</option>
                        <option value="2.2">Владимир-Волынский, Волынская область, Украина</option>
                        <option value="2.3">Горохов, Волынская область, Украина</option>
                        <option value="2.4">Иваничи, Волынская область, Украина</option>
                        <option value="2.5">Камень-Каширский, Волынская область, Украина</option>
                        <option value="2.6">Киверцы, Волынская область, Украина</option>
                        <option value="2.7">Ковель, Волынская область, Украина</option>
                        <option value="2.8">Луцк, Волынская область, Украина</option>
                        <option value="2.9">Любешов, Волынская область, Украина</option>
                        <option value="2.10">Любомль, Волынская область, Украина</option>
                        <option value="2.11">Маневичи, Волынская область, Украина</option>
                        <option value="2.12">Нововолынск, Волынская область, Украина</option>
                        <option value="2.13">Ратно, Волынская область, Украина</option>
                        <option value="2.14">Рожище, Волынская область, Украина</option>
                        <option value="2.15">Старая Выжевка, Волынская область, Украина</option>
                        <option value="2.16">Турийск, Волынская область, Украина</option>
                        <option value="2.17">Устилуг, Волынская область, Украина</option>
                        <option value="2.18">Цумань, Волынская область, Украина</option>
                        <option value="2.19">Шацк, Волынская область, Украина</option>

                        <option value="3">Днепропетровская область, Украина</option>
                        <option value="3.4">Днепр, Днепропетровская область, Украина</option>
                        <option value="3.1">Апостолово, Днепропетровская область, Украина</option>
                        <option value="3.2">Верхнеднепровск, Днепропетровская область, Украина</option>
                        <option value="3.3">Вольногорск, Днепропетровская область, Украина</option>
                        <!-- <option value="3.4">Днепр, Днепропетровская область, Украина</option> -->
                        <option value="3.5">Желтые Воды, Днепропетровская область, Украина</option>
                        <option value="3.6">Каменское, Днепропетровская область, Украина</option>
                        <option value="3.7">Кривой Рог, Днепропетровская область, Украина</option>
                        <option value="3.8">Марганец, Днепропетровская область, Украина</option>
                        <option value="3.9">Никополь, Днепропетровская область, Украина</option>
                        <option value="3.10">Новомосковск, Днепропетровская область, Украина</option>
                        <option value="3.11">Орджоникидзе, Днепропетровская область, Украина</option>
                        <option value="3.12">Павлоград, Днепропетровская область, Украина</option>
                        <option value="3.13">Перещепино, Днепропетровская область, Украина</option>
                        <option value="3.14">Першотравенск, Днепропетровская область, Украина</option>
                        <option value="3.15">Подгородное, Днепропетровская область, Украина</option>
                        <option value="3.16">Пятихатки, Днепропетровская область, Украина</option>
                        <option value="3.17">Синельниково, Днепропетровская область, Украина</option>
                        <option value="3.18">Терновка, Днепропетровская область, Украина</option>
                        <option value="3.19">Чаплинка, Днепропетровская область, Украина</option>

                        <option value="4">Донецкая область, Украина</option>
                        <option value="4.12">Донецк, Донецкая область, Украина</option>
                        <option value="4.1">Авдеевка, Донецкая область, Украина</option>
                        <option value="4.2">Александровка, Донецкая область, Украина</option>
                        <option value="4.3">Амвросиевка, Донецкая область, Украина</option>
                        <option value="4.4">Артемовск, Донецкая область, Украина</option>
                        <option value="4.5">Волноваха, Донецкая область, Украина</option>
                        <option value="4.6">Горловка, Донецкая область, Украина</option>
                        <option value="4.7">Дебальцево, Донецкая область, Украина</option>
                        <option value="4.8">Дзержинск, Донецкая область, Украина</option>
                        <option value="4.9">Димитров, Донецкая область, Украина</option>
                        <option value="4.10">Доброполье, Донецкая область, Украина</option>
                        <option value="4.11">Докучаевск, Донецкая область, Украина</option>
                        <!-- <option value="4.12">Донецк, Донецкая область, Украина</option> -->
                        <option value="4.13">Дружковка, Донецкая область, Украина</option>
                        <option value="4.14">Енакиево, Донецкая область, Украина</option>
                        <option value="4.15">Ждановка, Донецкая область, Украина</option>
                        <option value="4.16">Зугрэс, Донецкая область, Украина</option>
                        <option value="4.17">Кировское, Донецкая область, Украина</option>
                        <option value="4.18">Константиновка, Донецкая область, Украина</option>
                        <option value="4.19">Краматорск, Донецкая область, Украина</option>
                        <option value="4.20">Красноармейск, Донецкая область, Украина</option>
                        <option value="4.21">Красный Лиман, Донецкая область, Украина</option>
                        <option value="4.22">Майорск, Донецкая область, Украина</option>
                        <option value="4.23">Макеевка, Донецкая область, Украина</option>
                        <option value="4.24">Мариуполь, Донецкая область, Украина</option>
                        <option value="4.25">Марьинка, Донецкая область, Украина</option>
                        <option value="4.26">Новоазовск, Донецкая область, Украина</option>
                        <option value="4.27">Новогродовка, Донецкая область, Украина</option>
                        <option value="4.28">Селидово, Донецкая область, Украина</option>
                        <option value="4.29">Славянск, Донецкая область, Украина</option>
                        <option value="4.30">Снежное, Донецкая область, Украина</option>
                        <option value="4.31">Соледар, Донецкая область, Украина</option>
                        <option value="4.32">Старобешево, Донецкая область, Украина</option>
                        <option value="4.33">Торез, Донецкая область, Украина</option>
                        <option value="4.34">Угледар, Донецкая область, Украина</option>
                        <option value="4.35">Харцызск, Донецкая область, Украина</option>
                        <option value="4.36">Шахтерск, Донецкая область, Украина</option>
                        <option value="4.37">Ясиноватая, Донецкая область, Украина</option>

                        <option value="5">Житомирская область, Украина</option>
                        <option value="5.6">Житомир, Житомирская область, Украина</option>
                        <option value="5.1">Андрушевка, Житомирская область, Украина</option>
                        <option value="5.2">Барановка, Житомирская область, Украина</option>
                        <option value="5.3">Бердичев, Житомирская область, Украина</option>
                        <option value="5.4">Володарск-Волынский, Житомирская область, Украина</option>
                        <option value="5.5">Емильчино, Житомирская область, Украина</option>
                        <!-- <option value="5.6">Житомир, Житомирская область, Украина</option> -->
                        <option value="5.7">Иршанск, Житомирская область, Украина</option>
                        <option value="5.8">Коростень, Житомирская область, Украина</option>
                        <option value="5.9">Коростышев, Житомирская область, Украина</option>
                        <option value="5.10">Малин, Житомирская область, Украина</option>
                        <option value="5.11">Новоград-Волынский, Житомирская область, Украина</option>
                        <option value="5.12">Овруч, Житомирская область, Украина</option>
                        <option value="5.13">Олевск, Житомирская область, Украина</option>
                        <option value="5.14">Попельня, Житомирская область, Украина</option>
                        <option value="5.15">Радомышль, Житомирская область, Украина</option>
                        <option value="5.16">Романов, Житомирская область, Украина</option>
                        <option value="5.17">Черняхов, Житомирская область, Украина</option>

                        <option value="6">Закарпатская область, Украина</option>
                        <option value="6.1">Берегово, Закарпатская область, Украина</option>
                        <option value="6.2">Буштына, Закарпатская область, Украина</option>
                        <option value="6.3">Великий Бычков, Закарпатская область, Украина</option>
                        <option value="6.4">Виноградов, Закарпатская область, Украина</option>
                        <option value="6.5">Вышково, Закарпатская область, Украина</option>
                        <option value="6.6">Дубовое, Закарпатская область, Украина</option>
                        <option value="6.7">Иршава, Закарпатская область, Украина</option>
                        <option value="6.8">Королево, Закарпатская область, Украина</option>
                        <option value="6.9">Межгорье, Закарпатская область, Украина</option>
                        <option value="6.10">Мукачево, Закарпатская область, Украина</option>
                        <option value="6.11">Перечин, Закарпатская область, Украина</option>
                        <option value="6.12">Рахов, Закарпатская область, Украина</option>
                        <option value="6.13">Свалява, Закарпатская область, Украина</option>
                        <option value="6.14">Солотвина, Закарпатская область, Украина</option>
                        <option value="6.15">Тячев, Закарпатская область, Украина</option>
                        <option value="6.16">Ужгород, Закарпатская область, Украина</option>
                        <option value="6.17">Хуст, Закарпатская область, Украина</option>
                        <option value="6.18">Чоп, Закарпатская область, Украина</option>

                        <option value="7">Запорожская область, Украина</option>
                        <option value="7.9">Запорожье, Запорожская область, Украина</option>
                        <option value="7.1">Акимовка, Запорожская область, Украина</option>
                        <option value="7.2">Беляевка, Запорожская область, Украина</option>
                        <option value="7.3">Бердянск, Запорожская область, Украина</option>
                        <option value="7.4">Васильевка, Запорожская область, Украина</option>
                        <option value="7.5">Веселое, Запорожская область, Украина</option>
                        <option value="7.6">Вольнянск, Запорожская область, Украина</option>
                        <option value="7.7">Гуляйполе, Запорожская область, Украина</option>
                        <option value="7.8">Днепрорудное, Запорожская область, Украина</option>
                        <!-- <option value="7.9">Запорожье, Запорожская область, Украина</option> -->
                        <option value="7.10">Каменка-Днепровская, Запорожская область, Украина</option>
                        <option value="7.11">Куйбышево, Запорожская область, Украина</option>
                        <option value="7.12">Кушугум, Запорожская область, Украина</option>
                        <option value="7.13">Мелитополь, Запорожская область, Украина</option>
                        <option value="7.14">Михайловка, Запорожская область, Украина</option>
                        <option value="7.15">Молочанск, Запорожская область, Украина</option>
                        <option value="7.16">Орехов, Запорожская область, Украина</option>
                        <option value="7.17">Пологи, Запорожская область, Украина</option>
                        <option value="7.18">Приморск, Запорожская область, Украина</option>
                        <option value="7.19">Розовка, Запорожская область, Украина</option>
                        <option value="7.20">Токмак, Запорожская область, Украина</option>
                        <option value="7.21">Энергодар, Запорожская область, Украина</option>

                        <option value="8">Ивано-Франковская область, Украина</option>
                        <option value="8.8">Ивано-Франковск, Ивано-Франковская область, Украина</option>
                        <option value="8.1">Богородчаны, Ивано-Франковская область, Украина</option>
                        <option value="8.2">Болехов, Ивано-Франковская область, Украина</option>
                        <option value="8.3">Бурштын, Ивано-Франковская область, Украина</option>
                        <option value="8.4">Галич, Ивано-Франковская область, Украина</option>
                        <option value="8.5">Городенка, Ивано-Франковская область, Украина</option>
                        <option value="8.6">Делятин, Ивано-Франковская область, Украина</option>
                        <option value="8.7">Долина, Ивано-Франковская область, Украина</option>
                        <!-- <option value="8.8">Ивано-Франковск, Ивано-Франковская область, Украина</option> -->
                        <option value="8.9">Калуш, Ивано-Франковская область, Украина</option>
                        <option value="8.10">Коломыя, Ивано-Франковская область, Украина</option>
                        <option value="8.11">Косов, Ивано-Франковская область, Украина</option>
                        <option value="8.12">Ланчин, Ивано-Франковская область, Украина</option>
                        <option value="8.13">Надворная, Ивано-Франковская область, Украина</option>
                        <option value="8.14">Перегинское, Ивано-Франковская область, Украина</option>
                        <option value="8.15">Рогатин, Ивано-Франковская область, Украина</option>
                        <option value="8.16">Снятын, Ивано-Франковская область, Украина</option>
                        <option value="8.17">Тлумач, Ивано-Франковская область, Украина</option>
                        <option value="8.18">Тысменица, Ивано-Франковская область, Украина</option>
                        <option value="8.19">Яремче, Ивано-Франковская область, Украина</option>

                        <option value="9">Киевская область, Украина</option>
                        <option value="9.19">Киев, Киевская область, Украина</option>
                        <option value="9.1">Барышевка, Киевская область, Украина</option>
                        <option value="9.2">Белая Церковь, Киевская область, Украина</option>
                        <option value="9.3">Березань, Киевская область, Украина</option>
                        <option value="9.4">Богуслав, Киевская область, Украина</option>
                        <option value="9.5">Борисполь, Киевская область, Украина</option>
                        <option value="9.6">Бородянка, Киевская область, Украина</option>
                        <option value="9.7">Боярка, Киевская область, Украина</option>
                        <option value="9.8">Бровары, Киевская область, Украина</option>
                        <option value="9.9">Буча, Киевская область, Украина</option>
                        <option value="9.10">Васильков, Киевская область, Украина</option>
                        <option value="9.11">Вишневое, Киевская область, Украина</option>
                        <option value="9.12">Володарка, Киевская область, Украина</option>
                        <option value="9.13">Вышгород, Киевская область, Украина</option>
                        <option value="9.14">Глеваха, Киевская область, Украина</option>
                        <option value="9.15">Гостомель, Киевская область, Украина</option>
                        <option value="9.16">Иванков, Киевская область, Украина</option>
                        <option value="9.17">Ирпень, Киевская область, Украина</option>
                        <option value="9.18">Кагарлык, Киевская область, Украина</option>
                        <!-- <option value="9.19">Киев, Киевская область, Украина</option> -->
                        <option value="9.20">Коцюбинское, Киевская область, Украина</option>
                        <option value="9.21">Макаров, Киевская область, Украина</option>
                        <option value="9.22">Мироновка, Киевская область, Украина</option>
                        <option value="9.23">Обухов, Киевская область, Украина</option>
                        <option value="9.24">Переяслав-Хмельницкий, Киевская область, Украина</option>
                        <option value="9.25">Припять, Киевская область, Украина</option>
                        <option value="9.26">Ржищев, Киевская область, Украина</option>
                        <option value="9.27">Рокитное, Киевская область, Украина</option>
                        <option value="9.28">Сквира, Киевская область, Украина</option>
                        <option value="9.29">Славутич, Киевская область, Украина</option>
                        <option value="9.30">Тараща, Киевская область, Украина</option>
                        <option value="9.31">Тетиев, Киевская область, Украина</option>
                        <option value="9.32">Узин, Киевская область, Украина</option>
                        <option value="9.33">Украинка, Киевская область, Украина</option>
                        <option value="9.34">Фастов, Киевская область, Украина</option>
                        <option value="9.35">Чернобыль, Киевская область, Украина</option>
                        <option value="9.36">Яготин, Киевская область, Украина</option>

                        <option value="10">Кировоградская область, Украина</option>
                        <option value="10.1">Александрия, Кировоградская область, Украина</option>
                        <option value="10.2">Бобринец, Кировоградская область, Украина</option>
                        <option value="10.3">Власовка, Кировоградская область, Украина</option>
                        <option value="10.4">Гайворон, Кировоградская область, Украина</option>
                        <option value="10.5">Долинская, Кировоградская область, Украина</option>
                        <option value="10.6">Знаменка, Кировоградская область, Украина</option>
                        <option value="10.7">Кропивницкий, Кировоградская область, Украина</option>
                        <option value="10.8">Малая Виска, Кировоградская область, Украина</option>
                        <option value="10.9">Новая Прага, Кировоградская область, Украина</option>
                        <option value="10.10">Новоархангельск, Кировоградская область, Украина</option>
                        <option value="10.11">Новое, Кировоградская область, Украина</option>
                        <option value="10.12">Новомиргород, Кировоградская область, Украина</option>
                        <option value="10.13">Новоукраинка, Кировоградская область, Украина</option>
                        <option value="10.14">Первомайск, Кировоградская область, Украина</option>
                        <option value="10.15">Петрово, Кировоградская область, Украина</option>
                        <option value="10.16">Помошная, Кировоградская область, Украина</option>
                        <option value="10.17">Светловодск, Кировоградская область, Украина</option>
                        <option value="10.18">Смолино, Кировоградская область, Украина</option>

                        <option value="11">Крым (АРК), Украина</option>
                        <option value="11.1">Алупка, Крым (АРК), Украина</option>
                        <option value="11.2">Алушта, Крым (АРК), Украина</option>
                        <option value="11.3">Армянск, Крым (АРК), Украина</option>
                        <option value="11.4">Бахчисарай, Крым (АРК), Украина</option>
                        <option value="11.5">Белогорск, Крым (АРК), Украина</option>
                        <option value="11.6">Береговое, Крым (АРК), Украина</option>
                        <option value="11.7">Джанкой, Крым (АРК), Украина</option>
                        <option value="11.8">Евпатория, Крым (АРК), Украина</option>
                        <option value="11.9">Знаменка, Крым (АРК), Украина</option>
                        <option value="11.10">Инкерман, Крым (АРК), Украина</option>
                        <option value="11.11">Керчь, Крым (АРК), Украина</option>
                        <option value="11.12">Красногвардейское, Крым (АРК), Украина</option>
                        <option value="11.13">Красноперекопск, Крым (АРК), Украина</option>
                        <option value="11.14">Раздольное, Крым (АРК), Украина</option>
                        <option value="11.15">Саки, Крым (АРК), Украина</option>
                        <option value="11.16">Севастополь, Крым (АРК), Украина</option>
                        <option value="11.17">Симферополь, Крым (АРК), Украина</option>
                        <option value="11.18">Старый Крым, Крым (АРК), Украина</option>
                        <option value="11.19">Судак, Крым (АРК), Украина</option>
                        <option value="11.20">Феодосия, Крым (АРК), Украина</option>
                        <option value="11.21">Черноморское, Крым (АРК), Украина</option>
                        <option value="11.22">Щёлкино, Крым (АРК), Украина</option>
                        <option value="11.23">Ялта, Крым (АРК), Украина</option>

                        <option value="12">Луганская область, Украина</option>
                        <option value="12.20">Луганск, Луганская область, Украина</option>
                        <option value="12.1">Александровск, Луганская область, Украина</option>
                        <option value="12.2">Алмазная, Луганская область, Украина</option>
                        <option value="12.3">Алчевск, Луганская область, Украина</option>
                        <option value="12.4">Антрацит, Луганская область, Украина</option>
                        <option value="12.5">Артемовск, Луганская область, Украина</option>
                        <option value="12.6">Брянка, Луганская область, Украина</option>
                        <option value="12.7">Вахрушево, Луганская область, Украина</option>
                        <option value="12.8">Горное, Луганская область, Украина</option>
                        <option value="12.9">Горское, Луганская область, Украина</option>
                        <option value="12.10">Зимогорье, Луганская область, Украина</option>
                        <option value="12.11">Золотое, Луганская область, Украина</option>
                        <option value="12.12">Зоринск, Луганская область, Украина</option>
                        <option value="12.13">Ирмино, Луганская область, Украина</option>
                        <option value="12.14">Кировск, Луганская область, Украина</option>
                        <option value="12.15">Краснодон, Луганская область, Украина</option>
                        <option value="12.16">Краснопартизанск, Луганская область, Украина</option>
                        <option value="12.17">Красный Луч, Луганская область, Украина</option>
                        <option value="12.18">Кременная, Луганская область, Украина</option>
                        <option value="12.19">Лисичанск, Луганская область, Украина</option>
                        <!-- <option value="12.20">Луганск, Луганская область, Украина</option> -->
                        <option value="12.21">Лутугино, Луганская область, Украина</option>
                        <option value="12.22">Миусинск, Луганская область, Украина</option>
                        <option value="12.23">Молодогвардейск, Луганская область, Украина</option>
                        <option value="12.24">Новодружеск, Луганская область, Украина</option>
                        <option value="12.25">Новопсков, Луганская область, Украина</option>
                        <option value="12.26">Первомайск, Луганская область, Украина</option>
                        <option value="12.27">Перевальск, Луганская область, Украина</option>
                        <option value="12.28">Петровское, Луганская область, Украина</option>
                        <option value="12.29">Попасная, Луганская область, Украина</option>
                        <option value="12.30">Приволье, Луганская область, Украина</option>
                        <option value="12.31">Ровеньки, Луганская область, Украина</option>
                        <option value="12.32">Рубежное, Луганская область, Украина</option>
                        <option value="12.33">Сватово, Луганская область, Украина</option>
                        <option value="12.34">Свердловск, Луганская область, Украина</option>
                        <option value="12.35">Северодонецк, Луганская область, Украина</option>
                        <option value="12.36">Станица Луганская, Луганская область, Украина</option>
                        <option value="12.37">Старобельск, Луганская область, Украина</option>
                        <option value="12.38">Стаханов, Луганская область, Украина</option>
                        <option value="12.39">Суходольск, Луганская область, Украина</option>
                        <option value="12.40">Счастье, Луганская область, Украина</option>
                        <option value="12.41">Червонопартизанск, Луганская область, Украина</option>

                        <option value="13">Львовская область, Украина</option>
                        <option value="13.17">Львов, Львовская область, Украина</option>
                        <option value="13.1">Белз, Львовская область, Украина</option>
                        <option value="13.2">Бобрка, Львовская область, Украина</option>
                        <option value="13.3">Борислав, Львовская область, Украина</option>
                        <option value="13.4">Броды, Львовская область, Украина</option>
                        <option value="13.5">Буск, Львовская область, Украина</option>
                        <option value="13.6">Великие Мосты, Львовская область, Украина</option>
                        <option value="13.7">Винники, Львовская область, Украина</option>
                        <option value="13.8">Глиняны, Львовская область, Украина</option>
                        <option value="13.9">Городок, Львовская область, Украина</option>
                        <option value="13.10">Добромиль, Львовская область, Украина</option>
                        <option value="13.11">Дрогобыч, Львовская область, Украина</option>
                        <option value="13.12">Дубляны, Львовская область, Украина</option>
                        <option value="13.13">Жидачев, Львовская область, Украина</option>
                        <option value="13.14">Жолква, Львовская область, Украина</option>
                        <option value="13.15">Золочев, Львовская область, Украина</option>
                        <option value="13.16">Каменка-Бугская, Львовская область, Украина</option>
                        <!-- <option value="13.17">Львов, Львовская область, Украина</option> -->
                        <option value="13.18">Мостиска, Львовская область, Украина</option>
                        <option value="13.19">Николаев, Львовская область, Украина</option>
                        <option value="13.20">Новояворовск, Львовская область, Украина</option>
                        <option value="13.21">Новый Роздол, Львовская область, Украина</option>
                        <option value="13.22">Перемышляны, Львовская область, Украина</option>
                        <option value="13.23">Пустомыты, Львовская область, Украина</option>
                        <option value="13.24">Рава-Русская, Львовская область, Украина</option>
                        <option value="13.25">Радехов, Львовская область, Украина</option>
                        <option value="13.26">Рудки, Львовская область, Украина</option>
                        <option value="13.27">Самбор, Львовская область, Украина</option>
                        <option value="13.28">Сколе, Львовская область, Украина</option>
                        <option value="13.29">Сокаль, Львовская область, Украина</option>
                        <option value="13.30">Сосновка, Львовская область, Украина</option>
                        <option value="13.31">Старый Самбор, Львовская область, Украина</option>
                        <option value="13.32">Стебник, Львовская область, Украина</option>
                        <option value="13.33">Стрый, Львовская область, Украина</option>
                        <option value="13.34">Трускавец, Львовская область, Украина</option>
                        <option value="13.35">Угнев, Львовская область, Украина</option>
                        <option value="13.36">Хыров, Львовская область, Украина</option>
                        <option value="13.37">Червоноград, Львовская область, Украина</option>
                        <option value="13.38">Яворов, Львовская область, Украина</option>

                        <option value="14">Николаевская область, Украина</option>
                        <option value="14.13">Николаев, Николаевская область, Украина</option>
                        <option value="14.1">Александровка, Николаевская область, Украина</option>
                        <option value="14.2">Арбузинка, Николаевская область, Украина</option>
                        <option value="14.3">Баштанка, Николаевская область, Украина</option>
                        <option value="14.4">Березнеговатое, Николаевская область, Украина</option>
                        <option value="14.5">Братское, Николаевская область, Украина</option>
                        <option value="14.6">Веселиново, Николаевская область, Украина</option>
                        <option value="14.7">Вознесенск, Николаевская область, Украина</option>
                        <option value="14.8">Врадиевка, Николаевская область, Украина</option>
                        <option value="14.9">Доманевка, Николаевская область, Украина</option>
                        <option value="14.10">Еланец, Николаевская область, Украина</option>
                        <option value="14.11">Казанка, Николаевская область, Украина</option>
                        <option value="14.12">Кривое Озеро, Николаевская область, Украина</option>
                        <!-- <option value="14.13">Николаев, Николаевская область, Украина</option> -->
                        <option value="14.14">Новая Одесса, Николаевская область, Украина</option>
                        <option value="14.15">Новый Буг, Николаевская область, Украина</option>
                        <option value="14.16">Очаков, Николаевская область, Украина</option>
                        <option value="14.17">Первомайск, Николаевская область, Украина</option>
                        <option value="14.18">Снигиревка, Николаевская область, Украина</option>
                        <option value="14.19">Южноукраинск, Николаевская область, Украина</option>

                        <option value="15">Одесская область, Украина</option>
                        <option value="15.16">Одесса, Одесская область, Украина</option>
                        <option value="15.1">Ананьев, Одесская область, Украина</option>
                        <option value="15.2">Арциз, Одесская область, Украина</option>
                        <option value="15.3">Балта, Одесская область, Украина</option>
                        <option value="15.4">Белгород-Днестровский, Одесская область, Украина</option>
                        <option value="15.5">Беляевка, Одесская область, Украина</option>
                        <option value="15.6">Березовка, Одесская область, Украина</option>
                        <option value="15.7">Болград, Одесская область, Украина</option>
                        <option value="15.8">Великодолинское, Одесская область, Украина</option>
                        <option value="15.9">Измаил, Одесская область, Украина</option>
                        <option value="15.10">Ильичевск, Одесская область, Украина</option>
                        <option value="15.11">Килия, Одесская область, Украина</option>
                        <option value="15.12">Кодыма, Одесская область, Украина</option>
                        <option value="15.13">Котовск, Одесская область, Украина</option>
                        <option value="15.14">Любашевка, Одесская область, Украина</option>
                        <option value="15.15">Овидиополь, Одесская область, Украина</option>
                        <!-- <option value="15.16">Одесса, Одесская область, Украина</option> -->
                        <option value="15.17">Раздельная, Одесская область, Украина</option>
                        <option value="15.18">Рени, Одесская область, Украина</option>
                        <option value="15.19">Татарбунары, Одесская область, Украина</option>
                        <option value="15.20">Теплодар, Одесская область, Украина</option>
                        <option value="15.21">Ширяево, Одесская область, Украина</option>
                        <option value="15.22">Южное, Одесская область, Украина</option>

                        <option value="16">Полтавская область, Украина</option>
                        <option value="16.18">Полтава, Полтавская область, Украина</option>
                        <option value="16.1">Гадяч, Полтавская область, Украина</option>
                        <option value="16.2">Глобино, Полтавская область, Украина</option>
                        <option value="16.3">Горишные Плавни, Полтавская область, Украина</option>
                        <option value="16.4">Градижск, Полтавская область, Украина</option>
                        <option value="16.5">Гребенка, Полтавская область, Украина</option>
                        <option value="16.6">Дергачи, Полтавская область, Украина</option>
                        <option value="16.7">Диканька, Полтавская область, Украина</option>
                        <option value="16.8">Зеньков, Полтавская область, Украина</option>
                        <option value="16.9">Карловка, Полтавская область, Украина</option>
                        <option value="16.10">Кобеляки, Полтавская область, Украина</option>
                        <option value="16.11">Котельва, Полтавская область, Украина</option>
                        <option value="16.12">Кременчуг, Полтавская область, Украина</option>
                        <option value="16.13">Лохвица, Полтавская область, Украина</option>
                        <option value="16.14">Лубны, Полтавская область, Украина</option>
                        <option value="16.15">Миргород, Полтавская область, Украина</option>
                        <option value="16.16">Новые Санжары, Полтавская область, Украина</option>
                        <option value="16.17">Пирятин, Полтавская область, Украина</option>
                        <!-- <option value="16.18">Полтава, Полтавская область, Украина</option> -->
                        <option value="16.19">Решетиловка, Полтавская область, Украина</option>
                        <option value="16.20">Хорол, Полтавская область, Украина</option>
                        <option value="16.21">Червонозаводское, Полтавская область, Украина</option>
                        <option value="16.22">Чутово, Полтавская область, Украина</option>

                        <option value="17">Ровенская область, Украина</option>
                        <option value="17.15">Ровно, Ровенская область, Украина</option>
                        <option value="17.1">Березне, Ровенская область, Украина</option>
                        <option value="17.2">Вараш, Ровенская область, Украина</option>
                        <option value="17.3">Владимирец, Ровенская область, Украина</option>
                        <option value="17.4">Дубно, Ровенская область, Украина</option>
                        <option value="17.5">Дубровица, Ровенская область, Украина</option>
                        <option value="17.6">Заречное, Ровенская область, Украина</option>
                        <option value="17.7">Здолбунов, Ровенская область, Украина</option>
                        <option value="17.8">Квасилов, Ровенская область, Украина</option>
                        <option value="17.9">Клевань, Ровенская область, Украина</option>
                        <option value="17.10">Корец, Ровенская область, Украина</option>
                        <option value="17.11">Костополь, Ровенская область, Украина</option>
                        <option value="17.12">Млинов, Ровенская область, Украина</option>
                        <option value="17.13">Острог, Ровенская область, Украина</option>
                        <option value="17.14">Радивилов, Ровенская область, Украина</option>
                        <!-- <option value="17.15">Ровно, Ровенская область, Украина</option> -->
                        <option value="17.16">Рокитное, Ровенская область, Украина</option>
                        <option value="17.17">Сарны, Ровенская область, Украина</option>

                        <option value="18">Сумская область, Украина</option>
                        <option value="18.16">Сумы, Сумская область, Украина</option>
                        <option value="18.1">Ахтырка, Сумская область, Украина</option>
                        <option value="18.2">Белополье, Сумская область, Украина</option>
                        <option value="18.3">Бурынь, Сумская область, Украина</option>
                        <option value="18.4">Ворожба, Сумская область, Украина</option>
                        <option value="18.5">Воронеж, Сумская область, Украина</option>
                        <option value="18.6">Глухов, Сумская область, Украина</option>
                        <option value="18.7">Дружба, Сумская область, Украина</option>
                        <option value="18.8">Конотоп, Сумская область, Украина</option>
                        <option value="18.9">Краснополье, Сумская область, Украина</option>
                        <option value="18.10">Кролевец, Сумская область, Украина</option>
                        <option value="18.11">Лебедин, Сумская область, Украина</option>
                        <option value="18.12">Путивль, Сумская область, Украина</option>
                        <option value="18.13">Ромны, Сумская область, Украина</option>
                        <option value="18.14">Свесса, Сумская область, Украина</option>
                        <option value="18.15">Середина-Буда, Сумская область, Украина</option>
                        <!-- <option value="18.16">Сумы, Сумская область, Украина</option> -->
                        <option value="18.17">Тростянец, Сумская область, Украина</option>
                        <option value="18.18">Шостка, Сумская область, Украина</option>

                        <option value="19">Тернопольская область, Украина</option>
                        <option value="19.19">Тернополь, Тернопольская область, Украина</option>
                        <option value="19.1">Бережаны, Тернопольская область, Украина</option>
                        <option value="19.2">Борщев, Тернопольская область, Украина</option>
                        <option value="19.3">Бучач, Тернопольская область, Украина</option>
                        <option value="19.4">Великая Березовица, Тернопольская область, Украина</option>
                        <option value="19.5">Гусятин, Тернопольская область, Украина</option>
                        <option value="19.6">Залещики, Тернопольская область, Украина</option>
                        <option value="19.7">Збараж, Тернопольская область, Украина</option>
                        <option value="19.8">Зборов, Тернопольская область, Украина</option>
                        <option value="19.9">Козова, Тернопольская область, Украина</option>
                        <option value="19.10">Копычинцы, Тернопольская область, Украина</option>
                        <option value="19.11">Кременец, Тернопольская область, Украина</option>
                        <option value="19.12">Лановцы, Тернопольская область, Украина</option>
                        <option value="19.13">Монастыриска, Тернопольская область, Украина</option>
                        <option value="19.14">Подволочиск, Тернопольская область, Украина</option>
                        <option value="19.15">Подгайцы, Тернопольская область, Украина</option>
                        <option value="19.16">Почаев, Тернопольская область, Украина</option>
                        <option value="19.17">Скалат, Тернопольская область, Украина</option>
                        <option value="19.18">Теребовля, Тернопольская область, Украина</option>
                        <!-- <option value="19.19">Тернополь, Тернопольская область, Украина</option> -->
                        <option value="19.20">Хоростков, Тернопольская область, Украина</option>
                        <option value="19.21">Чертков, Тернопольская область, Украина</option>
                        <option value="19.22">Шумск, Тернопольская область, Украина</option>

                        <option value="20">Харьковская область, Украина</option>
                        <option value="20.20">Харьков, Харьковская область, Украина</option>
                        <option value="20.1">Балаклея, Харьковская область, Украина</option>
                        <option value="20.2">Барвенково, Харьковская область, Украина</option>
                        <option value="20.3">Богодухов, Харьковская область, Украина</option>
                        <option value="20.4">Валки, Харьковская область, Украина</option>
                        <option value="20.5">Великий Бурлук, Харьковская область, Украина</option>
                        <option value="20.6">Волчанск, Харьковская область, Украина</option>
                        <option value="20.7">Высокий, Харьковская область, Украина</option>
                        <option value="20.8">Дергачи, Харьковская область, Украина</option>
                        <option value="20.9">Змиев, Харьковская область, Украина</option>
                        <option value="20.10">Изюм, Харьковская область, Украина</option>
                        <option value="20.11">Комсомольское, Харьковская область, Украина</option>
                        <option value="20.12">Красноград, Харьковская область, Украина</option>
                        <option value="20.13">Купянск, Харьковская область, Украина</option>
                        <option value="20.14">Лозовая, Харьковская область, Украина</option>
                        <option value="20.15">Люботин, Харьковская область, Украина</option>
                        <option value="20.16">Мерефа, Харьковская область, Украина</option>
                        <option value="20.17">Новая Водолага, Харьковская область, Украина</option>
                        <option value="20.18">Первомайский, Харьковская область, Украина</option>
                        <option value="20.19">Солоницевка, Харьковская область, Украина</option>
                        <!-- <option value="20.20">Харьков, Харьковская область, Украина</option> -->
                        <option value="20.21">Чугуев, Харьковская область, Украина</option>

                        <option value="21">Херсонская область, Украина</option>
                        <option value="21.18">Херсон, Херсонская область, Украина</option>
                        <option value="21.1">Антоновка, Херсонская область, Украина</option>
                        <option value="21.2">Белозерка, Херсонская область, Украина</option>
                        <option value="21.3">Берислав, Херсонская область, Украина</option>
                        <option value="21.4">Великая Александровка, Херсонская область, Украина</option>
                        <option value="21.5">Великая Лепетиха, Херсонская область, Украина</option>
                        <option value="21.6">Геническ, Херсонская область, Украина</option>
                        <option value="21.7">Голая Пристань, Херсонская область, Украина</option>
                        <option value="21.8">Каланчак, Херсонская область, Украина</option>
                        <option value="21.9">Камышаны, Херсонская область, Украина</option>
                        <option value="21.10">Каховка, Херсонская область, Украина</option>
                        <option value="21.11">Новая Каховка, Херсонская область, Украина</option>
                        <option value="21.12">Новая Маячка, Херсонская область, Украина</option>
                        <option value="21.13">Новоалексеевка, Херсонская область, Украина</option>
                        <option value="21.14">Новотроицкое, Херсонская область, Украина</option>
                        <option value="21.15">Пойма, Херсонская область, Украина</option>
                        <option value="21.16">Скадовск, Херсонская область, Украина</option>
                        <option value="21.17">Таврийск, Херсонская область, Украина</option>
                        <!-- <option value="21.18">Херсон, Херсонская область, Украина</option> -->

                        <option value="22">Хмельницкая область, Украина</option>
                        <option value="22.16">Хмельницкий, Хмельницкая область, Украина</option>
                        <option value="22.1">Виньковцы, Хмельницкая область, Украина</option>
                        <option value="22.2">Волочиск, Хмельницкая область, Украина</option>
                        <option value="22.3">Городок, Хмельницкая область, Украина</option>
                        <option value="22.4">Деражня, Хмельницкая область, Украина</option>
                        <option value="22.5">Дунаевцы, Хмельницкая область, Украина</option>
                        <option value="22.6">Изяслав, Хмельницкая область, Украина</option>
                        <option value="22.7">Каменец-Подольский, Хмельницкая область, Украина</option>
                        <option value="22.8">Красилов, Хмельницкая область, Украина</option>
                        <option value="22.9">Летичев, Хмельницкая область, Украина</option>
                        <option value="22.10">Нетешин, Хмельницкая область, Украина</option>
                        <option value="22.11">Полонное, Хмельницкая область, Украина</option>
                        <option value="22.12">Понинка, Хмельницкая область, Украина</option>
                        <option value="22.13">Славута, Хмельницкая область, Украина</option>
                        <option value="22.14">Староконстантинов, Хмельницкая область, Украина</option>
                        <option value="22.15">Теофиполь, Хмельницкая область, Украина</option>
                        <!-- <option value="22.16">Хмельницкий, Хмельницкая область, Украина</option> -->
                        <option value="22.17">Шепетовка, Хмельницкая область, Украина</option>

                        <option value="23">Черкасская область, Украина</option>
                        <option value="23.17">Черкассы, Черкасская область, Украина</option>
                        <option value="23.1">Ватутино, Черкасская область, Украина</option>
                        <option value="23.2">Городище, Черкасская область, Украина</option>
                        <option value="23.3">Драбов, Черкасская область, Украина</option>
                        <option value="23.4">Жашков, Черкасская область, Украина</option>
                        <option value="23.5">Звенигородка, Черкасская область, Украина</option>
                        <option value="23.6">Золотоноша, Черкасская область, Украина</option>
                        <option value="23.7">Каменка, Черкасская область, Украина</option>
                        <option value="23.8">Канев, Черкасская область, Украина</option>
                        <option value="23.9">Корсунь-Шевченковский, Черкасская область, Украина</option>
                        <option value="23.10">Лысянка, Черкасская область, Украина</option>
                        <option value="23.11">Маньковка, Черкасская область, Украина</option>
                        <option value="23.12">Монастырище, Черкасская область, Украина</option>
                        <option value="23.13">Смела, Черкасская область, Украина</option>
                        <option value="23.14">Тальное, Черкасская область, Украина</option>
                        <option value="23.15">Умань, Черкасская область, Украина</option>
                        <option value="23.16">Христиновка, Черкасская область, Украина</option>
                        <!-- <option value="23.17">Черкассы, Черкасская область, Украина</option> -->
                        <option value="23.18">Чернобай, Черкасская область, Украина</option>
                        <option value="23.19">Чигирин, Черкасская область, Украина</option>
                        <option value="23.20">Шпола, Черкасская область, Украина</option>

                        <option value="24">Черниговская область, Украина</option>
                        <option value="24.16">Чернигов, Черниговская область, Украина</option>
                        <option value="24.1">Бахмач, Черниговская область, Украина</option>
                        <option value="24.2">Бобровица, Черниговская область, Украина</option>
                        <option value="24.3">Борзна, Черниговская область, Украина</option>
                        <option value="24.4">Городня, Черниговская область, Украина</option>
                        <option value="24.5">Десна, Черниговская область, Украина</option>
                        <option value="24.6">Ичня, Черниговская область, Украина</option>
                        <option value="24.7">Козелец, Черниговская область, Украина</option>
                        <option value="24.8">Корюковка, Черниговская область, Украина</option>
                        <option value="24.9">Мена, Черниговская область, Украина</option>
                        <option value="24.10">Нежин, Черниговская область, Украина</option>
                        <option value="24.11">Новгород-Северский, Черниговская область, Украина</option>
                        <option value="24.12">Носовка, Черниговская область, Украина</option>
                        <option value="24.13">Прилуки, Черниговская область, Украина</option>
                        <option value="24.14">Седнев, Черниговская область, Украина</option>
                        <option value="24.15">Семеновка, Черниговская область, Украина</option>
                        <!-- <option value="24.16">Чернигов, Черниговская область, Украина</option> -->
                        <option value="24.17">Щорс, Черниговская область, Украина</option>

                        <option value="25">Черновицкая область, Украина</option>
                        <option value="25.16">Черновцы, Черновицкая область, Украина</option>
                        <option value="25.1">Берегомет, Черновицкая область, Украина</option>
                        <option value="25.2">Вашковцы, Черновицкая область, Украина</option>
                        <option value="25.3">Вижница, Черновицкая область, Украина</option>
                        <option value="25.4">Герца, Черновицкая область, Украина</option>
                        <option value="25.5">Глыбокая, Черновицкая область, Украина</option>
                        <option value="25.6">Заставна, Черновицкая область, Украина</option>
                        <option value="25.7">Кельменцы, Черновицкая область, Украина</option>
                        <option value="25.8">Кицмань, Черновицкая область, Украина</option>
                        <option value="25.9">Красноильск, Черновицкая область, Украина</option>
                        <option value="25.10">Новоднестровск, Черновицкая область, Украина</option>
                        <option value="25.11">Новоселица, Черновицкая область, Украина</option>
                        <option value="25.12">Путила, Черновицкая область, Украина</option>
                        <option value="25.13">Сокиряны, Черновицкая область, Украина</option>
                        <option value="25.14">Сторожинец, Черновицкая область, Украина</option>
                        <option value="25.15">Хотин, Черновицкая область, Украина</option>
                        <!-- <option value="25.16">Черновцы, Черновицкая область, Украина</option> -->
                    </select>
                </label>

                <button type="submit" class="b-button-second b-search__button">
                    <span class="b-button-second__value b-button-second__value_bold b-button-second__value_lighten">Найти</span>
                </button>
            </form>
            <?php endif; ?>
            <?php if($this->params['showCategories']) : ?>
            <ul class="b-categories b-header__categories">
                <li class="b-blackout-page b-categories__blackout-page"></li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/1.png" alt="Детский мир" class="b-category__img">
                        </div>

                        <div class="b-category__name">Детский мир</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Детский мир»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/2.png" alt="Запчасти для автомобиля" class="b-category__img">
                        </div>

                        <div class="b-category__name">Запчасти для автомобиля</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Запчасти для автомобиля»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/3.png" alt="Дом и сад" class="b-category__img">
                        </div>

                        <div class="b-category__name">Дом и сад</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Дом и сад»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/4.png" alt="Мода и стиль" class="b-category__img">
                        </div>

                        <div class="b-category__name">Мода и стиль</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Мода и стиль»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/5.png" alt="Недвижемость" class="b-category__img">
                        </div>

                        <div class="b-category__name">Недвижемость</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Недвижемость»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/6.png" alt="Работа" class="b-category__img">
                        </div>

                        <div class="b-category__name">Работа</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Работа»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/7.png" alt="Электроника" class="b-category__img">
                        </div>

                        <div class="b-category__name">Электроника</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Электроника»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/8.png" alt="Хобби, отдых и спорт" class="b-category__img">
                        </div>

                        <div class="b-category__name">Хобби, отдых и спорт</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Хобби, отдых и спорт»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/9.png" alt="Транспорт" class="b-category__img">
                        </div>

                        <div class="b-category__name">Транспорт</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Транспорт»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="javascript:void(0)">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/10.png" alt="Животные" class="b-category__img">
                        </div>

                        <div class="b-category__name">Животные</div>
                    </a>

                    <ul class="b-subcategories b-category__subcategories">
                        <li class="b-subcategories__current">
                            <i class="b-subcategories__current-arrow pe-7s-angle-right"></i>
                            <a class="b-subcategories__current-link" href="categories.html">
                                Показать все объявления в категории
                                <span class="b-subcategories__current-name">«Животные»</span>
                            </a>
                        </li>

                        <li class="b-subcategories__arrow"></li>
                        <ul class="b-subcategories__other">

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская одежда
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская обувь
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские коляски
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детские автокресла
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детская мебель
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Игрушки
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Детский транспорт
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для кормления
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Товары для школьников
                                            </span>
                                </a>
                            </li>

                            <li class="b-subcategory b-subcategories__subcategory">
                                <a class="b-subcategory__link" href="categories.html">
                                    <i class="b-subcategory__arrow pe-7s-angle-right"></i>
                                    <span class="b-subcategory__name" title="name">
                                                Прочие детские товары
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="b-category b-categories__category">
                    <a class="b-category__link" href="categories.html">
                        <div class="b-category__img-wrp">
                            <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/tmp/categories/11.png" alt="Бизнес и услуги" class="b-category__img">
                        </div>

                        <div class="b-category__name">Бизнес и услуги</div>
                    </a>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</header>
