<?php
namespace modules\mod\frontend\forms;

use modules\mod\common\models\Mod;
use modules\mod\common\models\ModUser;
use yii\base\Model;

class ModelSignUpForm extends Model
{
  public $phone;
  public $email;
  public $fullName;
  public $age;
  public $height;
  public $weight;
  public $waist;
  public $hips;
  public $shoes;
  public $bust;
  public $password;
  public $passwordRepeat;

  public function attributeLabels()
  {
    return [
      'phone' => 'Номер телефона',
      'email' => 'Email',
      'fullName' => 'Полное имя',
      'age' => 'Возраст',
      'height' => 'Рост',
      'weight' => 'Вес',
      'waist' => 'Обхват талии',
      'hips' => 'Обхват бедер',
      'shoes' => 'Размер ноги',
      'bust' => 'Размер груди',
      'password' => 'Пароль',
      'passwordRepeat' => 'Подтверждение пароля',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['phone', 'fullName', 'age', 'weight', 'height', 'email'], 'required'],
      [['email', 'phone', 'fullName', 'age'], 'trim'],
      ['email', 'email'],
      [['email', 'phone', 'fullName'], 'string', 'max' => 255],
      [['weight', 'height', 'waist', 'hips', 'shoes', 'bust'], 'integer'],
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
    $mod->full_name = $this->fullName;
    $mod->age = $this->age;
    $mod->mod_user_id = $user->id;
    $mod->height = $this->height;
    $mod->weight = $this->weight;
    $mod->waist = $this->waist;
    $mod->hips = $this->hips;
    $mod->shoes = $this->shoes;
    $mod->bust = $this->bust;
    if(!$mod->save()) {
      $transaction->rollBack();
      return null;
    }

    $transaction->commit();

    return $user;
  }
}