<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pro_id',
            'pro_name',
            [
                'label'=>'Hình ảnh',
                'format'=>'raw',
                'value' => function($data){
                    $urlImage = Yii::$app->params['be'].'upload'; 
                    return Html::img($urlImage.'/'.$data->pro_image,[
                        'alt' => $data->pro_name,
                        'width' => 150,
                        'height' => 150
                    ]); 
                }
            ],
            [
                'label'=>'Giá',
                'format'=>'raw',
                'value' => function($data){
                    return number_format($data->pro_price).' VNĐ'; 
                }
            ],

            'pro_sale_off',
            //'cat_id',
            //'supplier',
            //'pro_size_id',
            //'pro_color_id',
            //'pro_made_id',
            //'description',
            //'date_sale_off',
            //'end_cate_sale',
            //'meta_keyword',
            //'meta_description',
            //'comment:ntext',
            //'complaint:ntext',
            //'status',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
