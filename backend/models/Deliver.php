<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "deliver".
 *
 * @property int $del_id
 * @property string $del_name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Deliver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deliver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['del_name', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['del_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'del_id' => 'Del ID',
            'del_name' => 'Del Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
