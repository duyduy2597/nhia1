<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add City', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cityname',
            [
                'label' => 'Created at',
                'value' => function ($model) {
                    $timezone  = +7;
                    return gmdate('d-m-Y H:i:s',$model->created_at + 3600*($timezone));
                }
            ],
            [
                'label' => 'Updated at',
                'value' => function ($model) {
                    $timezone  = +7;
                    return gmdate('d-m-Y H:i:s',$model->updated_at + 3600*($timezone));
                }
            ],
           //'updated_at',
            //'isDeleted',
            //'deletedUserId',
            //'deletedTime:datetime',

            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Bạn có muốn xóa \''.$model->cityname.'\'',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
