<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "size".
 *
 * @property int $size_id
 * @property string $size_name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Size extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'size';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size_name', 'created_at', 'updated_at'], 'required'],
            [[ 'created_at', 'updated_at'], 'integer'],
            [['size_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'size_id' => 'Size ID',
            'size_name' => 'Size Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
