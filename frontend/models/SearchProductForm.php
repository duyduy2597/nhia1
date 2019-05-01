<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;
use frontend\models\mysql\Order;
/**
 * Password reset form
 */
class SearchProductForm extends Model
{
    public $fieldSearch;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['fieldSearch', 'trim'],
            ['fieldSearch', 'required', 'message' => ''],
            ['fieldSearch', 'string', 'min' => 5,'max' => 150],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fieldSearch' => '',
        ];
    }
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function Search()
    {   
        
    }
}
