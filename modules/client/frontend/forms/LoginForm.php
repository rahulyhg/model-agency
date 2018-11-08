<?php
namespace modules\client\frontend\forms;

use modules\client\common\models\Client;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $phone;
    public $password;
    public $rememberMe = true;

    private $_client;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'required', 'message' => 'Укажите номер телефона'],
            [['password'], 'required', 'message' => 'Укажите пароль'],
            ['rememberMe', 'boolean'],
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
            $client = $this->getClient();
            if (!$client || !$client->validatePassword($this->password)) {
                $this->addError($attribute, 'Не правильный номер телефона или пароль.');
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
            return Yii::$app->user->login($this->getClient(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Client|null
     */
    protected function getClient()
    {
        if ($this->_client === null) {
            $this->_client = Client::findByPhone($this->phone);
        }

        return $this->_client;
    }
}
