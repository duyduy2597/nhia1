<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $sup_id
 * @property string $sup_name
 * @property string $mobile
 * @property string $address
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sup_name', 'mobile', 'address', 'created_at', 'updated_at'], 'required'],
            [[ 'created_at', 'updated_at'], 'integer'],
            [['sup_name', 'address'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sup_id' => 'Sup ID',
            'sup_name' => 'Sup Name',
            'mobile' => 'Mobile',
            'address' => 'Address',
         
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
