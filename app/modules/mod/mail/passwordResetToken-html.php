<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \modules\mod\common\models\ModUser */
$x = $user->password_reset_token;
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['mod/auth/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Здравствуйте, <?= Html::encode($user->mod->full_name) ?>.</p>

    <p>Для сброса пароля перейдите по ссылке ниже:</p>

    <p><?= Html::a($resetLink, $resetLink) ?></p>
</div>
