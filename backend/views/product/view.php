<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->pro_id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pro_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pro_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pro_id',
            'pro_name',
            [
                'attribute'=>'pro_image',
                'value'=>Yii::getAlias('@proimageUrl') . '/' .$model->pro_image,
                'format'=>['image',['width' =>'100','height'=>'100']]
            
            ],
            'pro_price',
            'pro_sale_off',
            'cat_id',
            'supplier',
            'pro_size_id',
            'pro_color_id',
            'pro_made_id',
            'description',
            'date_sale_off',
            'end_cate_sale',
            'meta_keyword',
            'meta_description',
            'comment:ntext',
            'complaint:ntext',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
