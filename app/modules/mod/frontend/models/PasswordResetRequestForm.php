<?php

namespace modules\mod\frontend\models;

use modules\mod\common\models\ModUser;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
  public $email;


  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      ['email', 'trim'],
      ['email', 'required'],
      ['email', 'email'],
      ['email', 'exist',
        'targetClass' => ModUser::class,
        'filter' => ['status' => ModUser::STATUS_ACTIVE],
        'message' => 'Пользователь с таким email не найден!'
      ],
    ];
  }

  /**
   * Sends an email with a link, for resetting the password.
   *
   * @return bool whether the email was send
   */
  public function sendEmail()
  {
    /* @var $user User */
    $user = ModUser::findOne([
      'status' => ModUser::STATUS_ACTIVE,
      'email' => $this->email,
    ]);

    if (!$user) {
      return false;
    }

    if (!ModUser::isPasswordResetTokenValid($user->password_reset_token)) {
      $user->generatePasswordResetToken();
      if (!$user->save()) {
        return false;
      }
    }

    return Yii::$app
      ->mailer
      ->compose(
        [
          'html' => 'passwordResetToken-html',
          'text' => 'passwordResetToken-text'
        ],
        ['user' => $user]
      )
      ->setFrom([Yii::$app->params['supportEmail'] => 'Робот Celeb Cloud'])
      ->setTo($this->email)
      ->setSubject('Сброс пароля для ' . Yii::$app->name)
      ->send();
  }
}
