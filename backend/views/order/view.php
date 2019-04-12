<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1>Khach hang: <?= Html::encode($model->use_name); ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>User name</th>
                <th>Email</th>
                <th>Dien thoai</th>
                <th>from</th>
                <th>to</th>
                <th>nguoi gui</th>
                <th>nguoi nhan</th>
                <th>Request</th>
            </tr>
        </thead>
        <tbody>
         <tr>
            <td><?php echo $model['use_name'] ?></td>
            <td><?php echo $model['email'] ?></td>
            <td><?php echo $model['mobile'] ?></td>
            <td><?php echo $model['address'] ?></td>
            <td><?php echo $model['user_ship'] ?></td>
            <td><?php echo $model['mobile_ship'] ?></td>
            <td><?php echo $model['address_ship'] ?></td>
            <td><?php echo $model['request'] ?></td>
        </tr>
    </tbody>
</table>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Gia</th>
            <th>So luong</th>
            <th>Thanh tien</th>
        </tr>
    </thead>
    <tbody>
        <?php $tongTien = 0; ?>
     <?php foreach ($arrDetailOrder as $product): ?>
        <tr>
            <td><?php echo $product['product']['pro_name']; ?></td>
            <td><?php echo $product['gia']; ?></td>
            <td><?php echo $product['soluong']; ?></td>
            <td><?php echo $product['thanhTien']; ?></td>
            <?php $tongTien = $tongTien + (int)$product['thanhTien']; ?>
        </tr>
    <?php endforeach ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><b>Tong tien</b>: <?php echo $tongTien; ?> </td>
    </tr>
</tbody>
</table>
    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            'use_id',
            'use_name',
            'email:email',
            'mobile',
            'address',
            'user_ship',
            'mobile_ship',
            'address_ship',
            'request',
            'updated_at',
            'status',
            'created_at',
        ],
    ]) */?>

</div>
