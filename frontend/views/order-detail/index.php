<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\mysql\Order;
$urlImage = Yii::$app->params['be'].'upload'; 
$detail = $orderDetail->attributes; 
$detail = json_decode($detail['details'],true);
//var_dump($orderDetail);die; 
?>

<section>
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li class="active">Order Detail</li>
			</ol>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">THÔNG TIN NGƯỜI NHẬN</div>
				<div class="panel-body">
					<ul class="list-group">
						<li class="list-group-item"><b>User Id:</b> <?php echo $detail['buyer']['userId']; ?></li>
						<li class="list-group-item"><b>Số chứng minh:</b> <?php echo $detail['buyer']['cmnd']; ?></li>
						<li class="list-group-item"><b>User Phone:</b> <?php echo $detail['buyer']['phone']; ?></li>
						<li class="list-group-item"><b>Email:</b> <?php echo $detail['buyer']['email']; ?></li>
						<li class="list-group-item"><b>Địa chỉ:</b> <?php echo $detail['buyer']['address']; ?></li>
					</ul>								
				</div>
			</div>
		</div>
	</div>
</section>

<section id="cart_items">
	<div class="container">
		<h4>CHI TIẾT ĐƠN ĐẶT HÀNG</h4>
		<div class="table-responsive cart_info">
			<table class="table table-condensed table-responsive">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Giá</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php $tongTien = 0; ?>
					<?php foreach ($detail['details'] as $key => $product): ?>
						<tr id="cart-item-<?php echo $key; ?>">
							<td class="cart_product">
								<?php $image = Html::img($urlImage.'/'.$product['pro_image'], ['alt'=> $product['pro_name'],'width' => 110,'height' => 110]);?>
								<?php echo Html::a($image,Url::to(['site/detail-product','id' => $product['id']])); ?>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $product['pro_name']; ?></a></h4>
							</td>
							<td class="cart_price">
								<p><?php echo number_format($product['pro_price']); ?> VNĐ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">								
									<?php echo $product['quantity']; ?>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price" id='total-item-<?php echo $key; ?>'><?php echo number_format(($product['quantity']*$product['pro_price'])); ?></p> VNĐ
							</td>
						</tr>
						<?php $tongTien = $tongTien + ($product['quantity']*$product['pro_price']); ?>
					<?php endforeach ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>						
						<td><b>Total:</b> <span id="displayCartTotal"><?php echo number_format($tongTien).' VNĐ'; ?></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>						
						<td><b>Trạng thái:</b> <span><?php echo Order::STATUS[$orderDetail['status']]; ?></span></td>
					</tr>
					<?php if ($orderDetail['status'] == 1): ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>						
							<td><?php echo Html::a('Hủy đơn',Url::to(['/site/login','cancel' => json_encode([
								'order_id' => $orderDetail->order_id,
								'cmnd' => $orderDetail->cmnd
							])]),[
								'class' => 'btn btn-default check_out'
								]); ?></td>
							</tr>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> 