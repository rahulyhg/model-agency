<?php
namespace modules\mod\frontend\forms;

use modules\mod\common\models\Mod;
use modules\mod\common\models\ModUser;
use yii\base\Model;

class ModelSignUpForm extends Model
{
  public $phone;
  public $email;
  public $firstName;
  public $lastName;
  public $middleName;
  public $age;
  public $password;
  public $passwordRepeat;

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['phone', 'firstName', 'lastName', 'middleName', 'age'], 'required'],
      [['email', 'phone', 'firstName', 'lastName', 'middleName', 'age'], 'trim'],
      ['email', 'email'],
      [['email', 'phone', 'firstName', 'lastName', 'middleName'], 'string', 'max' => 255],
      [['email'], 'unique', 'targetClass' => ModUser::class, 'message' => 'This email address has already been taken.'],
      [['phone'], 'unique', 'targetClass' => ModUser::class, 'message' => 'This phone has already been taken.'],
      [['password', 'passwordRepeat'], 'required'],
      [['password', 'passwordRepeat'], 'string', 'min' => 6],
      ['passwordRepeat', 'compare', 'compareAttribute' => 'password'],
    ];
  }

  /**
   * @return ModUser|null
   * @throws \yii\base\Exception
   * @throws \yii\db\Exception
   */
  public function signup()
  {
    if (!$this->validate()) {
      return null;
    }

    $transaction = \Yii::$app->db->beginTransaction();

    $user = new ModUser();
    $user->phone = $this->phone;
    $user->email = $this->email;
    $user->setPassword($this->password);
    $user->generateAuthKey();
    if(!$user->save()) {
      $transaction->rollBack();
      return null;
    }

    $mod = new Mod();
    $mod->first_name = $this->firstName;
    $mod->last_name = $this->lastName;
    $mod->middle_name = $this->middleName;
    $mod->age = $this->age;
    $mod->mod_user_id = $user->id;
    if(!$mod->save()) {
      $transaction->rollBack();
      return null;
    }

    $transaction->commit();

    return $user;
  }
}