<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Order;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'use_id',
            'use_name',
            'email',
            'mobile',

            //'address',
            //'user_ship',
            //'mobile_ship',
            //'address_ship',
            //'request',
            //'updated_at',
            [
                'label'=>'Trạng thái',
                'format'=>'raw',
                'value' => function($data){
                    return Order::STATUS[$data->status]; 
                }
            ],
            [
                'label'=>'Ngày mua',
                'format'=>'raw',
                'value' => function($data){
                    return date('d-m-Y H:m',$data->created_at); 
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view} {delete} ',
                'buttons' => [
                    'view' => function($url, $model, $key) {    
                        return Html::tag('a', '<span class="glyphicon glyphicon-eye-open"></span>',
                           [
                            'onclick' => 'viewDetailOrder("'.$model->order_id.'");',
                            'data-toggle' => 'modal',
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

    <!-- Modal -->
    <div class="modal fade" id="modalDetailOrder" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Order Detail</h4>
          </div>
          <div class="modal-body">
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><h3>THÔNG TIN KHÁCH HÀNG</h3></div></div>
            <div class="table-responsive">          
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Cmnd</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody id="buyer-info">

            </tbody>
        </table>
    </div>
    <div class="row"><div class="col-sm-6 col-sm-offset-3"><h3>THÔNG TIN SẢN PHẨM ORDER</h3></div></div>
    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Image</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody id="details-order">
    </tbody>
</table>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
</div>
