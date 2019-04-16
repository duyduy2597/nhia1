<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "made".
 *
 * @property int $made_id
 * @property string $made_name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Made extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'made';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['made_name', 'created_at', 'updated_at'], 'required'],
            [[ 'created_at', 'updated_at'], 'integer'],
            [['made_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'made_id' => 'Made ID',
            'made_name' => 'Made Name',
            
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
