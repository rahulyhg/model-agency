<?php

namespace modules\client\frontend\forms;

use modules\client\common\models\Client;
use modules\client\Module;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
  public $email;
  public $phone;
  public $name;
  public $password;
  public $passwordRepeat;

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'email' => Module::t('registration', 'Email'),
      'phone' => Module::t('registration', 'Телефон'),
      'name' => Module::t('registration', 'Имя'),
      'password' => Module::t('registration', 'Новый пароль'),
      'passwordRepeat' => Module::t('registration', 'Повторите пароль'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [

      ['email', 'trim'],
      ['email', 'required'],
      ['email', 'email'],
      ['email', 'string', 'max' => 255],
      ['email', 'unique', 'targetClass' => Client::class, 'message' => Module::t('registration', 'Этот email уже используется другим пользователем')],

      ['phone', 'trim'],
      ['phone', 'required'],
      ['phone', 'string', 'max' => 255],
      ['phone', 'unique', 'targetClass' => Client::class, 'message' => Module::t('registration', 'Этот номер уже используется другим пользователем')],

      ['name', 'trim'],
      ['name', 'required'],
      ['name', 'string', 'min' => 2, 'max' => 255],

      ['password', 'required'],
      ['password', 'string', 'min' => 6],

      ['passwordRepeat', 'required'],
      ['passwordRepeat', 'string', 'min' => 6],
      [['passwordRepeat'], 'compare', 'compareAttribute' => 'password', 'message' => Module::t('registration', 'Пароли не совпадают')],
    ];
  }

  /**
   * Signs user up.
   *
   * @return Client|null the saved model or null if saving fails
   */
  public function signup()
  {
    if (!$this->validate()) {
      return null;
    }

    $client = new Client();
    $client->name = $this->name;
    $client->email = $this->email;
    $client->phone = $this->phone;
    $client->setPassword($this->password);
    $client->generateAuthKey();

    return $client->save() ? $client : null;
  }
}
