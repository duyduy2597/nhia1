<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap\Alert;
use yii\widgets\Menu;
use frontend\widgets\headertopWidget;
use frontend\widgets\headermiddleWidget;
use frontend\widgets\headerbottomWidget;
use frontend\widgets\sliderWidget;
use frontend\widgets\categoryWidget;
use frontend\widgets\brandsproductsWidget;
use frontend\widgets\pricerangeWidget;
use frontend\widgets\shippingWidget;
use frontend\widgets\featuresitemsWidget;
use frontend\widgets\categorytabWidget;
use frontend\widgets\recommendeditemsWidget;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->registerCsrfMetaTags() ?>
	<title><?php echo $this->title; ?></title>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>
	<header id="header"><!--header-->
		<?= headertopWidget::widget(); ?>

		<div class="header-middle">
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="/"><img src="/images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">							
								<?php if (!Yii::$app->user->isGuest): ?>
									<li><a href="/user/profile?id=<?php echo Yii::$app->user->identity->id; ?>"><i class="fa fa-user"></i> <?php echo Yii::$app->user->identity->username; ?></a></li>
								<?php endif ?>
								<li><a href="/user/search-order"><i class="fa fa-crosshairs"></i> Search Order</a></li>
								<li><a href="/cart/index"><i class="fa fa-shopping-cart"></i> Cart <span id="itemsCart"><?php echo (isset(Yii::$app->session['cart']) && count(Yii::$app->session['cart']) > 0) ? '('.count(Yii::$app->session['cart']).')' : '(0)'; ?></span></a></li>
								<?php if (Yii::$app->user->isGuest): ?>
									<li><a href="/site/signup">Signup</a></li>
									<li><a href="/site/login"><i class="fa fa-lock"></i> Login</a></li>
								<?php endif ?>
								<?php if (!Yii::$app->user->isGuest): ?>
									<li><a href="/site/logout" data-method='post'><i class="fa fa-sign-out"></i> Logout</a></li>
								<?php endif ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?= headerbottomWidget::widget(); ?>
	</header><!--/header-->
	
	<?= $content ?>
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="/images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="/images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="/images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="/images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="/images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="fb-page"
						data-href="https://www.facebook.com/Vui-Vui-Vẻ-947456168740674/"
						data-tabs="messages"
						data-width="400"
						data-height="300"
						data-small-header="true">
						<div class="fb-xfbml-parse-ignore">
							<blockquote></blockquote>
						</div>
					</div>
				</div>
					<!-- <div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div> -->
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chăm Sóc Khách Hàng</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="https://www.facebook.com/Vui-Vui-Vẻ-947456168740674">Liên Hệ Face Book</a></li>
								<li><a href="#">HotLine:0931290387</a></li>
								<li><a href="#">Email:nhutduyhuflit@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div>
			<a href="https://www.facebook.com/Vui-Vui-Vẻ-947456168740674/" title="Gửi tin nhắn cho chúng tôi trên Facebook">Liên hệ với chúng tôi trên Facebook</a>
		</div>
		<script type="text/javascript">
			window.fbAsyncInit = function () {
				FB.init({
					appId: '657549527725084',
					xfbml: true,
					version: 'v2.6'
				});
			};
			(function (d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {
					return;
				}
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
