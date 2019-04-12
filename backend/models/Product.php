<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $pro_id
 * @property string $pro_name
 * @property string $pro_image
 * @property int $pro_price
 * @property string $pro_sale_off
 * @property int $cat_id
 * @property int $supplier
 * @property int $pro_size_id
 * @property int $pro_color_id
 * @property int $pro_made_id
 * @property string $description
 * @property string $date_sale_off
 * @property string $end_cate_sale
 * @property string $meta_keyword
 * @property string $meta_description
 * @property string $comment
 * @property string $complaint
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_name', 'pro_image', 'pro_price', 'created_at', 'updated_at'], 'required'],
            [['pro_price', 'cat_id', 'supplier', 'pro_size_id', 'pro_color_id', 'pro_made_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['date_sale_off', 'end_cate_sale'], 'safe'],
            [['comment', 'complaint'], 'string'],
            [['pro_name', 'pro_image', 'pro_sale_off', 'description', 'meta_keyword', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pro_id' => 'Pro ID',
            'pro_name' => 'Pro Name',
            'pro_image' => 'Pro Image',
            'pro_price' => 'Pro Price',
            'pro_sale_off' => 'Pro Sale Off',
            'cat_id' => 'Cat ID',
            'supplier' => 'Supplier',
            'pro_size_id' => 'Pro Size ID',
            'pro_color_id' => 'Pro Color ID',
            'pro_made_id' => 'Pro Made ID',
            'description' => 'Description',
            'date_sale_off' => 'Date Sale Off',
            'end_cate_sale' => 'End Cate Sale',
            'meta_keyword' => 'Meta Keyword',
            'meta_description' => 'Meta Description',
            'comment' => 'Comment',
            'complaint' => 'Complaint',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
