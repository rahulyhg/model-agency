<?php

/* @var $this yii\web\View */
/* @var $user \modules\mod\common\models\ModUser */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/mod/auth/reset-password', 'token' => $user->password_reset_token]);
?>
Здравствуйте, <?= $user->mod->full_name ?>.

Для сброса пароля перейдите по ссылке ниже:

<?= $resetLink ?>
