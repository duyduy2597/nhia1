<?php

namespace frontend\models\mysql;

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
            [['prent_id',], 'integer'],
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
            //'cat_icon' => 'Thumbnail',
            'meta_keyword' => 'Meta Keyword',
            'meta_description' => 'Meta Description',
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

    
    public static function showCategories($prent_id = 0, $char = '')
    {
        $categories = Category::find()->where([
            'isDeleted' => 0
        ])->all();

        $cate_child = array();
        foreach ($categories as $key => $cate)
        {
            $cate = $cate->attributes;
            if ($cate['prent_id'] == $prent_id)
            {
                $cate_child[] = $cate;
                unset($categories[$key]);
            }
        }

        if ($cate_child)
        {   
            echo '<ul class="list-group">';
            foreach ($cate_child as $key => $cate)
            {
                echo '<li class="list-group-item"><a href='.($prent_id == 0 ? 'javascript:;': '/site/search-product-by-cate?cateId='.$cate['cat_id'].'').'>'.($prent_id == 0 ? '+ ':'').$char.$cate['cat_name'].'</a>';
                        self::showCategories($cate['cat_id'], $char.'|---');
                echo '</li>';
            }
            echo '</ul>';
        }
    }


    public static function getCategories($parent_id = 0, $exclude = '', $space = '', $categories='')
    {
        if($parent_id == 0){
            $space = '';
            $categories = array();
        }else{
            $space .='|---';
        }

        $model = Category::findAll([
            'prent_id' => $parent_id,
        ]);
        if(!empty($model)){
            foreach ($model as $key) {
                if($key->cat_id == $exclude) continue;
                $categories[$key->cat_id] = array('cat_id'=>$key->cat_id, 'cat_name'=> $space.$key->cat_name);
                $categories = self::getCategories($key->cat_id, $exclude, $space, $categories);
            }
        }

        return $categories;
    }

}