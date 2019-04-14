<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "category".
 *
 * @property int $cat_id
 * @property string $cat_name
 * @property int $prent_id
 * @property string $cat_icon
 * @property string $meta_keyword
 * @property string $meta_description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name',], 'required'],
            [['prent_id', 'status',], 'integer'],
            [['cat_name', 'meta_keyword', 'meta_description'], 'string', 'max' => 255],
            [['cat_name'], 'unique'],
            [['cat_icon'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_name' => 'Cat Name',
            'prent_id' => 'Prent ID',
            'cat_icon' => 'Thumbnail',
            'meta_keyword' => 'Meta Keyword',
            'meta_description' => 'Meta Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    
    public static function showCategories($categories,$prent_id = 0, $char = '')
    {
        foreach ($categories as $key => $cate)
        {
            $cate = $cate->attributes;
            if ($cate['prent_id'] == $prent_id)
            {
                echo '<option value="'.$cate['prent_id'].'">';
                echo $char . $cate['cat_name'];
                echo '</option>';
            // Xóa chuyên mục đã lặp
                unset($categories[$key]);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::showCategories($categories, $cate['cat_id'], $char.'|---');
            }
        }
    }
}
