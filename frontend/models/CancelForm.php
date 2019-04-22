<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class CancelForm extends Model
{   

    public $secretKey;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['secretKey', 'required'],
            ['secretKey', 'string', 'min' => 5, 'max' => 7],
        ];
    }

    public function attributeLabels()
    {
        return [
            'secretKey' => 'Mã đặt hàng',
        ];
    }

    public function checkValidateSecretKey($hashKey)
    {
        $check = Yii::$app->security->validatePassword($this->secretKey, $hashKey);
        if ($check) {
            return $check;
        }else{
            $this->addError('secretKey', 'Mã đặt hàng không hợp lệ, vui lòng kiểm tra lại !');
            return false;
        }
    }

}
