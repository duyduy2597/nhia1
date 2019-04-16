<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class CheckoutForm extends Model
{
    public $address;
    public $phone;
    public $cmnd;
    public $email;
   // public $


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['address', 'required'],
            ['cmnd', 'required'],
            ['phone', 'required'],
            ['email', 'required'],
            ['address', 'string', 'min' => 8, 'max' => 255],
            ['cmnd', 'string', 'min' => 9, 'max' => 12],
            
             ['email', 'trim'],          
             ['email', 'email'],
             ['email', 'string', 'max' => 255],
            // ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'address' => 'Địa chỉ người nhận',
            'phone' => 'Số điện thoại người nhận',
            'cmnd' => 'Số chứng minh thư',
            'email' => 'Email'
        ];
    }

}
