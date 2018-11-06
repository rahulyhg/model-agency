<?php
/**
 * @var $this \yii\web\View
 * @var $elementClass string
 */
?>
<div class="b-my-profile <?= $elementClass ?>">
  <div class="b-my-profile__login-details">
    <div class="b-my-profile__title">Данные для входа</div>

    <label class="b-field b-my-profile__field">
      <span class="b-field-name b-field__name">Ваш email:</span>
      <input class="b-field__input" type="email" name="email" value="ivan.ivanov@gmail.com">
    </label>

    <label class="b-field b-my-profile__field">
      <span class="b-field-name b-field__name">Ваш номер телефона:</span>
      <input id="phone" class="b-field__input" type="tel" name="phone" value="0676773333">
    </label>

    <label class="b-field b-my-profile__field">
      <span class="b-field-name b-field__name">Новый пароль:</span>
      <input class="b-field__input" type="password" name="password">
    </label>

    <label class="b-field b-my-profile__field">
      <span class="b-field-name b-field__name">Повторить пароль:</span>
      <input class="b-field__input" type="password" name="password-repeat">
    </label>
  </div>

  <div class="b-my-profile__additional-information">
    <div class="b-my-profile__title">Дополнительные данные</div>

    <label class="b-field b-my-profile__field">
      <span class="b-field-name b-field__name">Контактное лицо:</span>
      <input class="b-field__input" type="text" name="name" value="Иванов Иван Иванович">
    </label>

    <label class="b-field-select b-my-profile__field">
      <span class="b-field-name b-field-select__name">Страна:</span>
      <select class="b-select2 b-field-select__select2" data-select2-search
              disabled name="country">
        <option value="1" selected>Украина</option>
      </select>
    </label>

    <label class="b-field-select b-my-profile__field">
      <span class="b-field-name b-field-select__name">Область:</span>
      <select class="b-select2 b-field-select__select2" data-select2-search
              name="region">
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

    <label class="b-field-select b-my-profile__field">
      <span class="b-field-name b-field-select__name">Город:</span>
      <select class="b-select2 b-field-select__select2" data-select2-search
              name="sity">
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

    <button type="submit" class="b-button-second b-my-profile__save">
      <span class="b-button-second__value">Сохранить</span>
    </button>
  </div>
</div>
