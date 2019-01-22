<?php
/**
 * @var $this \yii\web\View
 */

use yii\helpers\Url;

?>
<nav class="b-nav-line b-main__nav-line">
  <div class="b-nav-line__left">
    <a class="b-link b-nav-line__bread-crumbs" href="index.html">
      <i class="b-link__icon fas fa-home"></i>
      <span class="b-link__texts">
        <span class="b-link__text-first">Home</span>
      </span>
    </a>
  </div>
  <?php if (Yii::$app->user->isGuest) : ?>
    <div class="b-nav-line__right">
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/auth/model']) ?>">
        <i class="b-link__icon fas fa-user-ninja"></i>
        <span class="b-link__texts b-link__texts_underline">
          <span class="b-link__text-first b-link__text-first_uppercase">Models </span>
          <span class="b-link__text-second b-link__text-first_uppercase">sign in</span>
        </span>
      </a>
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/auth/manager']) ?>">
        <i class="b-link__icon fas fa-user-tie"></i>
        <span class="b-link__texts b-link__texts_underline">
          <span class="b-link__text-first">User </span>
          <span class="b-link__text-second">sign in</span>
        </span>
      </a>
    </div>
  <?php else: ?>
    <div class="b-nav-line__right">
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/profile/model/index']) ?>">
        <i class="b-link__icon fas fa-user"></i>
        <span class="b-link__texts b-link__texts_underline">
        <span class="b-link__text-first b-link__text-first_uppercase">My profile</span>
      </span>
      </a>
      <a class="b-link b-nav-line__login" href="<?= Url::to(['/mod/auth/logout']) ?>">
        <i class="b-link__icon fas fa-sign-out-alt"></i>
        <span class="b-link__texts b-link__texts_underline">
        <span class="b-link__text-second">Logout</span>
      </span>
      </a>
    </div>
  <?php endif; ?>
</nav>
