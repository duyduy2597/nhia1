<div class="header-bottom"><!--header-bottom-->
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="mainmenu pull-left">
					<ul class="nav navbar-nav collapse navbar-collapse">
						<li><a href="/" class="active">Home</a></li>
						<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
							<ul role="menu" class="sub-menu">
								<li><a href="shop.html">Products</a></li>
								<li><a href="product-details.html">Product Details</a></li> 
								<li><a href="checkout.html">Checkout</a></li> 
								<li><a href="cart.html">Cart</a></li> 
								<li><a href="login.html">Login</a></li> 
							</ul>
						</li> 
						<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
							<ul role="menu" class="sub-menu">
								<li><a href="blog.html">Blog List</a></li>
								<li><a href="blog-single.html">Blog Single</a></li>
							</ul>
						</li> 
						<li><a href="404.html">404</a></li>
						<li><a href="contact-us.html">Contact</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-3">	
				<form action="/site/search-product" method="post" class="searchform">
					<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
					<input type="text" name="txtSearchProduct" id="txtSearchProduct" required placeholder="Search product name or price..." />
					<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
	</div>
		</div><!--/header-bottom-->