<?php
$urlImage = Yii::$app->params['be'].'upload'; 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
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
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->

				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li><a href="#comments" data-toggle="tab">Comments</a></li>
							<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
						</ul>
					</div>
					<div class="tab-content">		
						<div class="tab-pane fade" id="comments" >
							
						</div>

						<div class="tab-pane fade active in" id="reviews" >
							<div class="col-sm-12">
								<ul>
									<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
									<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
									<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
								</ul>
								<p><b>Write Your Review</b></p>
								
								<div class="login-form">																	
									<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

									<?= $form->field($model, 'name')->textInput(['autofocus' => false,'placeholder' => 'Your name']) ?>

									<?= $form->field($model, 'email')->textInput(['autofocus' => false,'placeholder' => 'Your email']) ?>

									<?= $form->field($model, 'body')->textArea() ?>

									<div class="form-group">
										<?= Html::submitButton('Submit', ['class' => 'btn btn-default',]) ?>
									</div>

									<?php ActiveForm::end(); ?>
								</div>
							</div>
						</div>

					</div>
				</div><!--/category-tab-->				
			</div>
		</div>
	</div>
</section>