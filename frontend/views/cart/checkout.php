<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$urlImage = Yii::$app->params['be'].'upload'; 
$this->registerJsFile("@web/js/cart/index.js",['depends' => 'yii\web\JqueryAsset']);
?>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<h2>Checkout $</h2>
		</div>
	</div>
	<div class="row">
		<div class="category-tab"><!--category-tab-->
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#paypal" data-toggle="tab">PAYPAL</a></li>
					<li><a href="#tienMat" data-toggle="tab">TIỀN MẶT</a></li>					
					<li><a href="#cart" data-toggle="tab">CART</a></li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="paypal" >
					<div class="col-sm-6 col-sm-offset-3">
						<div class="signup-form"><!--sign up form-->
							<h2>New User Signup!</h2>
							<form action="#">
								<input type="text" placeholder="Name"/>
								<input type="email" placeholder="Email Address"/>
								<input type="password" placeholder="Password"/>
								<button type="submit" class="btn btn-default">Signup</button>
							</form>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="tienMat" >
					<div class="col-sm-6 col-sm-offset-3">
						<div class="login-form">
							<!--login form-->
							<h2>THÔNG TIN NGƯỜI NHẬN</h2>
							<?php $form = ActiveForm::begin(['id' => 'checkout-form']); ?>

							<?= $form->field($model, 'address')->textInput(['autofocus' => true,'placeholder' => 'address']) ?>

							<?= $form->field($model, 'phone')->textInput(['autofocus' => true,'placeholder' => 'phone']) ?>
							<?php if (Yii::$app->user->isGuest): ?>
								<?= $form->field($model, 'cmnd')->textInput(['autofocus' => true,'placeholder' => 'cmnd']) ?>

								<?= $form->field($model, 'email')->textInput(['autofocus' => true,'placeholder' => 'Email']) ?>
							<?php endif ?>

							<div class="form-group">			
								<?= Html::submitButton('Submit', ['class' => 'btn btn-default',]) ?>
							</div>

							<?php ActiveForm::end(); ?>
						</div><!--/login form-->
					</div>
				</div>
				
				<div class="tab-pane fade" id="cart">
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
											<a class="cart_quantity_delete" href="javascript:;" onclick='removeItemFromCart(<?php echo $key; ?>)'><i class="fa fa-times"></i></a>
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
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/category-tab-->
	</div>
</div>