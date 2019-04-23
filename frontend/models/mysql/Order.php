<?php

namespace frontend\models\mysql;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "order".
 *
 * @property int $order_id
 * @property string $use_id
 * @property string $use_name
 * @property string $email
 * @property string $mobile
 * @property string $address
 * @property string $user_ship
 * @property string $mobile_ship
 * @property string $address_ship
 * @property string $request
 * @property int $updated_at
 * @property int $status
 * @property int $created_at
 */
class Order extends ActiveRecord
{

    const STATUS = [
        0 => 'Đã hủy',
        1 => 'Chưa giao',
        2 => 'Đã giao'
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['email', 'mobile', 'address', 'user_ship'], 'required'],
            [['updated_at', 'created_at'], 'integer'],
           // [['mobile','email', 'address', 'user_ship'], 'string', 'max' => 255],
           // [['mobile', 'mobile_ship', 'request'], 'string', 'max' => 11],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    // public function attributeLabels()
    // {
    //     return [
    //         'order_id' => 'Order ID',
    //         'use_id' => 'Use ID',
    //         'use_name' => 'Use Name',
    //         'email' => 'Email',
    //         'mobile' => 'Mobile',
    //         'address' => 'Address',
    //         'user_ship' => 'User Ship',
    //         'mobile_ship' => 'Mobile Ship',
    //         'address_ship' => 'Address Ship',
    //         'request' => 'Request',
    //         'updated_at' => 'Updated At',
    //         'created_at' => 'Created At',
    //     ];
    // }
    public function createOrder($model,$currentData,$total = "")
    {
        $buyer = Yii::$app->user->identity;
        $details = [
            'buyer' => [
                'userId' => !is_null($buyer) ? $buyer['id'] : null,
                'email' => !is_null($buyer) ? $buyer['email'] : $model->email,
                'username' => null,
                'cmnd' => !is_null($buyer) ? $buyer['cmnd'] : $model->cmnd,
                'phone' => $model->phone,
                'address' => $model->address,
                'attributes' => !is_null($buyer) ? $buyer['attributes'] : '',
            ],
            'details' => $currentData,
            'type' => Yii::$app->params['checkoutType'][$model->checkoutType],
            'totalPrice' => $total
        ];      
        $order = new Order();
        $order->use_id = !is_null($buyer) ? $buyer['id'] : 0;
        $order->details = json_encode($details);
        $order->status = 1;
        $order->email = !is_null($buyer) ? $buyer['email'] : $model->email;
        $order->use_name = '';
        $order->mobile = $model->phone;
        $order->address = $model->address;
        $order->user_ship = '';
        $order->mobile_ship = '';
        $order->address_ship = '';
        $order->request = '';
        $order->cmnd = !is_null($buyer) ? $buyer['cmnd'] : $model->cmnd;
        $secretKey = rand(10000,1000000);
        $order->secretkey  = Yii::$app->security->generatePasswordHash($secretKey);
        if ($order->save()) {
           Yii::$app->mailer->compose()
           ->setFrom(Yii::$app->params['adminEmail'])
           ->setTo($order->email)
           ->setSubject('MÃ XÁC THỰC ĐẶT HÀNG')
           ->setTextBody('abc')
           ->setHtmlBody('<p>Mã order của bạn là: <b>'.$order->order_id.'</b></p><br /><p>Mã xác thực đặt hàng của bạn là: <b>'.$secretKey.'</b></p><br /><p><b>Vui lòng giữ riêng những thông tin này.</b></p>')
           ->send();
           return [
                'status' => true,
                'order' => $order
           ];
       }
       return false;
   }
}
