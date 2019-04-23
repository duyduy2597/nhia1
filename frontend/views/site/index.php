<?php 
use frontend\widgets\featuresitemsWidget;
use frontend\widgets\categorytabWidget;
use frontend\widgets\recommendeditemsWidget;

use yii\widgets\Breadcrumbs;
use frontend\widgets\sliderWidget;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
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
					<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<div class="panel panel-default">
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
								<h4 class="panel-title"><a href="#">Kids</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Fashion</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Households</a></h4>
							</div>
						</div>
					</div>
					<!--/category-products-->
				</div>
			</div>
			
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Sản phẩm hot</h2>
					<?php 
					$urlImage = Yii::$app->params['be'].'upload'; 
					?>
					<?php foreach ($arrProduct as $key => $pro): ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<?php $image = Html::img($urlImage.'/'.$pro['pro_image'], ['alt'=> $pro['pro_name']]);?>
										<?php echo Html::a($image,Url::to(['site/detail-product','id' => $key])); ?>
										<h2><?php echo number_format($pro['pro_price']); ?> VNĐ</h2>
										<p><?php echo $pro['pro_name']; ?></p>
										<a href="javascript:;" onclick='addToCart(<?php echo json_encode([
											'id' => $key,
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

