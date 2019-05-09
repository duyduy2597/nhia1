<?php
$urlImage = Yii::$app->params['be'].'upload'; 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->registerJsFile("@web/js/product-detail/index.js",['depends' => 'yii\web\JqueryAsset']);
?>
<section>
	<div class="container">
		<div class="row">			
			<div class="padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<img src="<?php echo $urlImage.'/'.$productDetail['pro_image']; ?>" alt="" />
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">

							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<div class="item active">
									<a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>	
								</div>
								<div class="item">
									<a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
								</div>										
							</div>

							<!-- Controls -->
							<a class="left item-control" href="#similar-product" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right item-control" href="#similar-product" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="product-information"><!--/product-information-->
							<h2><?php echo $productDetail['pro_name']; ?></h2>
							<p><b>Giá:</b> <?php echo $productDetail['pro_price']; ?></p>
							<a href="javascript:;" onclick='addToCart(<?php echo json_encode([
								'id' => $productDetail['pro_id'],
								'pro_name' => $productDetail['pro_name'],
								'quantity' => 1,
								'pro_price' => $productDetail['pro_price'],
								'pro_image' => $productDetail['pro_image'],
								]); ?>)' class="btn btn-default add-to-cart">
								<i class="fa fa-shopping-cart"></i> Add to cart
							</a>
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->

				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
						</ul>
					</div>
					<div class="tab-content">		
						<div class="tab-pane fade active in" id="comments" >
							<div class="row bootstrap snippets">
								<div class="col-sm-12">
									<div class="comment-wrapper">
										<div class="panel panel-default" >
											<div class="panel-heading" style="background-color: #FE980F;color: #FFFFFF;">
												Viết bình luận
											</div>
											<div class="panel-body">
												<div class="login-form">																	
													<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>						
													<?= $form->field($model, 'email')->textInput(['autofocus' => false,'placeholder' => 'Your email']) ?>

													<?= $form->field($model, 'body')->textInput(['autofocus' => false,'placeholder' => 'Bình luận của bạn']) ?>

													<div class="form-group">
														<?= Html::submitButton('Submit', ['class' => 'btn btn-default col-sm-offset-10',]) ?>
													</div>

													<?php ActiveForm::end(); ?>
												</div>
												<div class="clearfix"></div>
												<hr>
												<ul class="media-list" id="list-comment">

												</ul>

											</div>
											<div class="panel-footer"><div class="row"><div id='block-btnLoadMoreComment' class="col-sm-6 col-sm-offset-3"></div></div></div>
										</div>
									</div>

								</div>
							</div>
						</div>						
					</div>
				</div>				
			</div>
		</div>
	</div>
</section>