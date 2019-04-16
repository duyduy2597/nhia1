<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property string $payment_id
 * @property int $order_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $isDeleted
 * @property int $deletedUserId
 * @property int $deletedTime
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'created_at', 'updated_at'], 'required'],
            [['order_id', 'created_at', 'updated_at', 'isDeleted', 'deletedUserId', 'deletedTime'], 'integer'],
            [['payment_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'order_id' => 'Order ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'isDeleted' => 'Is Deleted',
            'deletedUserId' => 'Deleted User ID',
            'deletedTime' => 'Deleted Time',
        ];
    }
}
