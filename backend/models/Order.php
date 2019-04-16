<?php

namespace backend\models;

use Yii;

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
class Order extends \yii\db\ActiveRecord
{
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
            //[['use_id', 'use_name', 'email', 'mobile', 'address', 'user_ship', 'mobile_ship', 'address_ship', 'request', 'updated_at', 'created_at'], 'required'],
            [['updated_at', 'created_at'], 'integer'],
            [['use_id', 'use_name', 'email', 'address', 'user_ship', 'address_ship'], 'string', 'max' => 255],
            [['mobile', 'mobile_ship', 'request'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'use_id' => 'Use ID',
            'use_name' => 'Use Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'user_ship' => 'User Ship',
            'mobile_ship' => 'Mobile Ship',
            'address_ship' => 'Address Ship',
            'request' => 'Request',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
