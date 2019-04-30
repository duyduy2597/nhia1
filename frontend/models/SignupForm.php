<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $fullName;
    public $address;
    public $birthYear;
    public $email;
    public $cmnd;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            
            ['cmnd', 'trim'],
            ['cmnd', 'required'],
            ['cmnd', 'string', 'min' => 9, 'max' => 12],
            ['cmnd', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Chứng minh nhân dân này đã được đăng ký, vui lòng kiểm tra lại !'],

            ['fullName', 'trim'],
            ['fullName', 'required'],

            ['address', 'trim'],
            ['address', 'required'],

            ['birthYear', 'trim'],
            ['birthYear', 'required'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['birthYear', 'cmnd'], 'integer'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $attributes = [
            'fullName' => $this->fullName,
            'birthYear' => $this->birthYear,
            'address' => $this->address
        ];
        $user = new User();
        $user->role_id = 2;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->cmnd = $this->cmnd;
        $user->isActive = true;
        $user->attributes = json_encode($attributes);
        return $user->save() ? $user : null;
    }
}
