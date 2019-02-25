<?php
namespace modules\mod\frontend\forms;

use modules\mod\common\models\ModUser;
use Yii;
use yii\base\Model;

class ModelLoginForm extends Model
{
  public $phoneOrEmail;
  public $password;
  public $rememberMe = true;

  private $_user;

  public function attributeLabels()
  {
    return [
      'phoneOrEmail' => 'Номер телефона или email',
      'password' => 'Пароль',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      // username and password are both required
      [['phoneOrEmail', 'password'], 'required'],
      // rememberMe must be a boolean value
      ['rememberMe', 'boolean'],
      // password is validated by validatePassword()
      ['password', 'validatePassword'],
    ];
  }

  /**
   * Validates the password.
   * This method serves as the inline validation for password.
   *
   * @param string $attribute the attribute currently being validated
   * @param array $params the additional name-value pairs given in the rule
   */
  public function validatePassword($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $user = $this->getUser();
      if (!$user || !$user->validatePassword($this->password)) {
        $this->addError($attribute, 'Неверный номер телефона / email или пароль.');
      }
    }
  }

  /**
   * Logs in a user using the provided username and password.
   *
   * @return bool whether the user is logged in successfully
   */
  public function login()
  {
    if ($this->validate()) {
      return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
    }

    return false;
  }

  /**
   * Finds user by [[username]]
   *
   * @return ModUser|null
   */
  protected function getUser()
  {
    if ($this->_user === null) {
      $user = ModUser::findByPhone($this->phoneOrEmail);
      if(!$user) {
        $user = ModUser::findByEmail($this->phoneOrEmail);
      }
      $this->_user = $user;
    }
    return $this->_user;
  }
}