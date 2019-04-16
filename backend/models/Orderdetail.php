<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property int $detail_id
 * @property int $order_id
 * @property int $pro_id
 * @property int $pro_price
 * @property int $pro_amount
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Orderdetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'pro_id', 'pro_price', 'pro_amount',  'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_id' => 'Detail ID',
            'order_id' => 'Order ID',
            'pro_id' => 'Pro ID',
            'pro_price' => 'Pro Price',
            'pro_amount' => 'Pro Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
