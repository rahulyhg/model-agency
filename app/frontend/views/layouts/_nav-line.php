<?php
/**
 * @var $this \yii\web\View
 */

use yii\helpers\Url;

?>
<nav class="b-nav-line b-main__nav-line">
  <div class="b-nav-line__left">
    <a class="b-link b-nav-line__bread-crumbs" href="<?= Url::to(['/']) ?>">
      <i class="b-link__icon fas fa-home"></i>
      <span class="b-link__texts">
        <span class="b-link__text-first">Главная</span>
      </span>
    </a>
  </div>
  <?php if (Yii::$app->user->isGuest) : ?>
    <div class="b-nav-line__right">
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/signup/role']) ?>">
        <i class="b-link__icon fas fa-sign-in-alt"></i>
        <span class="b-link__texts b-link__texts_underline">
          <span class="b-link__text-first b-link__text-first_uppercase">Присоединиться </span>
          <span class="b-link__text-second b-link__text-first_uppercase">сейчас!</span>
        </span>
      </a>
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/auth/model']) ?>">
        <i class="b-link__icon fas fa-female"></i>
        <span class="b-link__texts b-link__texts_underline">
          <span class="b-link__text-first b-link__text-first_uppercase">Вход для </span>
          <span class="b-link__text-second b-link__text-first_uppercase">модели</span>
        </span>
      </a>
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/auth/manager']) ?>">
        <i class="b-link__icon fas fa-user-tie"></i>
        <span class="b-link__texts b-link__texts_underline">
          <span class="b-link__text-first">Вход для </span>
          <span class="b-link__text-second">менеджера</span>
        </span>
      </a>
    </div>
  <?php else: ?>
    <div class="b-nav-line__right">
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/profile/model/index']) ?>">
        <i class="b-link__icon fas fa-user"></i>
        <span class="b-link__texts b-link__texts_underline">
        <span class="b-link__text-first b-link__text-first_uppercase">Мой кабинет</span>
      </span>
      </a>
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/auth/logout']) ?>">
        <i class="b-link__icon fas fa-sign-out-alt"></i>
        <span class="b-link__texts b-link__texts_underline">
        <span class="b-link__text-second">Выйти</span>
      </span>
      </a>
    </div>
  <?php endif; ?>
</nav>
