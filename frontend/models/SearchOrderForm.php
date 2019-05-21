<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;
use frontend\models\mysql\Order;
/**
 * Password reset form
 */
class SearchOrderForm extends Model
{
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'required'],
            ['email', 'string', 'min' => 10,'max' => 255],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function Search()
    {   
        $order = Order::find()->select(['order_id','email', 'mobile','address','cmnd','details','created_at','status'])
        ->where(['email' => $this->email])
        ->orderBy(['created_at' => SORT_DESC])
        ->asArray()
        ->all();
        return $order;
    }
}
