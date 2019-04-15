<?php 
use yii\helpers\Html;
use yii\helpers\Url;
$urlImage = Yii::$app->params['be'].'upload'; 
?>
<?php if (count($data) > 0): ?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="/">Home</a></li>
					<li class="active">Shopping Cart</li>
				</ol>
			</div>
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
						<?php foreach ($data as $key => $product): ?>
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
										<a id ='up-quantity-item-<?php echo $key; ?>' class="cart_quantity_up" href="javascript:;" onclick='quantityUpdate(<?php echo json_encode($product); ?>,"up")'> <i class="fa fa-plus" aria-hidden="true"></i> </a>
										<input class="cart_quantity_input" type="text" id='quantity-item-<?php echo $key; ?>' value="<?php echo $product['quantity']; ?>" autocomplete="off" size="2">
										<a id ='down-quantity-item-<?php echo $key; ?>' class="cart_quantity_down" href="javascript:;" onclick='quantityUpdate(<?php echo json_encode($product); ?>,"down")'><i class="fa fa-minus" aria-hidden="true"></i> </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price" id='total-item-<?php echo $key; ?>'><?php echo number_format(($product['quantity']*$product['pro_price'])); ?></p> VNĐ
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<?php $tongTien = $tongTien + ($product['quantity']*$product['pro_price']); ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> 
	<!--/#cart_items-->


	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>Free</span></li>
							<li>Eco Tax <span>Free</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span id="displayCartTotal"><?php echo number_format($tongTien).' VNĐ'; ?></span></li>
						</ul>
						<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/#do_action-->
	<?php else: ?>
		<section>
			<div class="container">
				<div class="heading">
					<h3>Giỏ hàng trống</h3>
				</div>
			</div>
		</section>
		<?php endif ?>