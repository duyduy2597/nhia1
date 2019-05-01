<?php 
use frontend\widgets\featuresitemsWidget;
use frontend\widgets\categorytabWidget;
use frontend\widgets\recommendeditemsWidget;

use yii\widgets\Breadcrumbs;
use frontend\widgets\sliderWidget;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\mysql\Category;
?>

<!--
<section id="slider">
	<?= sliderWidget::widget(); ?>
</section>-->
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<!--category-productsr-->
					<div class="panel-group category-products" id="accordian">
						<?php Category::showCategories(); ?>
						<!-- <div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										Sportswear
									</a>
								</h4>
							</div>
							<div id="sportswear" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="#">Nike </a></li>
										<li><a href="#">Under Armour </a></li>
										<li><a href="#">Adidas </a></li>
										<li><a href="#">Puma</a></li>
										<li><a href="#">ASICS </a></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#test">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										Kids
									</a>
								</h4>
							</div>
							<div id="test" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li>
											<div class="panel-heading">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#test" href="#test1">
														<span class="badge pull-right"><i class="fa fa-plus"></i></span>
														test 1
													</a>
												</h4>
											</div>
											<div id="test1" class="panel-collapse collapse">
												<div class="panel-body">
													<ul>
														<li><a href="#">6 </a></li>
														<li><a href="#">7</a></li>
														<li><a href="#">8 </a></li>
														<li><a href="#">9</a></li>
														<li><a href="#">10 </a></li>
													</ul>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Fashion</a></h4>
							</div>
						</div> -->
					</div> 
					<!--/category-products-->
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center"><?php echo $titleContent; ?></h2>
					<?php 
					$urlImage = Yii::$app->params['be'].'upload'; 
					?>
					<?php foreach ($arrProduct as $key => $pro): ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<?php $image = Html::img($urlImage.'/'.$pro['pro_image'], ['alt'=> $pro['pro_name']]);?>
										<?php echo Html::a($image,Url::to(['site/detail-product','id' => $pro['pro_id']])); ?>
										<h2><?php echo number_format($pro['pro_price']); ?> VNĐ</h2>
										<p><?php echo $pro['pro_name']; ?></p>
										<a href="javascript:;" onclick='addToCart(<?php echo json_encode([
											'id' => $pro['pro_id'],
											'pro_name' => $pro['pro_name'],
											'quantity' => 1,
											'pro_price' => $pro['pro_price'],
											'pro_image' => $pro['pro_image'],
											]); ?>)' class="btn btn-default add-to-cart">
											<i class="fa fa-shopping-cart"></i> Add to cart
										</a>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<!-- <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li> -->
										</ul>
									</div>
								</div>
							</div>
						<?php endforeach ?>	
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>

