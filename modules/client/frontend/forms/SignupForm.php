<?php

namespace modules\client\frontend\forms;

use modules\client\common\models\Client;
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
      'email' => 'Email',
      'phone' => 'Телефон',
      'name' => 'Имя',
      'password' => 'Новый пароль',
      'passwordRepeat' => 'Повторите пароль',
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
      ['email', 'unique', 'targetClass' => Client::class, 'message' => 'Этот email уже используется другим пользователем'],

      ['phone', 'trim'],
      ['phone', 'required'],
      ['phone', 'string', 'max' => 255],
      ['phone', 'unique', 'targetClass' => Client::class, 'message' => 'Этот номер уже используется другим пользователем'],

      ['name', 'trim'],
      ['name', 'required'],
      ['name', 'string', 'min' => 2, 'max' => 255],

      ['password', 'required'],
      ['password', 'string', 'min' => 6],

      ['passwordRepeat', 'required'],
      ['passwordRepeat', 'string', 'min' => 6],
      [['passwordRepeat'], 'compare', 'compareAttribute' => 'password', 'message' => "Пароли не совпадают"],
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
