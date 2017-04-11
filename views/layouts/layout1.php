<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="MediaCenter, Template, eCommerce">
        <meta name="robots" content="all">

        <title>MediaCenter - Responsive eCommerce Template</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        
        <!-- Customizable CSS -->
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/green.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/owl.transitions.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">

        <!-- Demo Purpose Only. Should be removed in production -->
        <link rel="stylesheet" href="assets/css/config.css">

        <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
        <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
        <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
        <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
        <link href="assets/css/navy.css" rel="alternate stylesheet" title="Navy color">
        <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
        <!-- Demo Purpose Only. Should be removed in production : END -->
        
        <!-- Icons/Glyphs -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.js"></script>
            <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
<body>
    
    <div class="wrapper">
        <!-- ============================================================= TOP NAVIGATION ============================================================= -->
    <nav class="top-bar animate-dropdown">
    <div class="container">
        <div class="col-xs-12 col-sm-6 no-margin">
            <ul>
                <li><a href="<?php echo yii\helpers\Url::to(['index/index']) ?>">首页</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['index/index']) ?>">所有分类</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['cart/index']) ?>">我的购物车</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['order/index']) ?>">我的订单</a></li>
            </ul>
        </div><!-- /.col -->
        
        <div class="col-xs-12 col-sm-6 no-margin">
            <ul class="right">
            <?php if (\Yii::$app->session['isLogin'] == 1): ?>
                您好 , 欢迎您回来 <?php echo \Yii::$app->session['loginname']; ?> , <a href="<?php echo yii\helpers\Url::to(['member/logout']); ?>">退出</a>
            <?php else: ?>
                <li><a href="<?php echo yii\helpers\Url::to(['member/auth']); ?>">注册</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['member/auth']); ?>">登录</a></li>
            <?php endif; ?>
            </ul>
        </div><!-- /.col -->
    </div><!-- /.container -->
    </nav><!-- /.top-bar -->

<header class="no-padding-bottom header-alt">
    <div class="container no-padding">
        
        <div class="col-xs-12 col-md-3 logo-holder">

  </div><!-- /.logo-holder -->

        <div class="col-xs-12 col-md-6 top-search-holder no-margin">
            <div class="contact-row">
    <div class="phone inline">
        <i class="fa fa-phone"></i> (+800) 123 456 7890
    </div>
    <div class="contact inline">
        <i class="fa fa-envelope"></i> <span class="le-color"><?php 
            if(isset(Yii::$app->session['user']['isLogin'])){
                echo '欢迎 ';
                echo Yii::$app->session['user']['user'];
                echo "<a href='".yii\helpers\Url::to(['member/logout'])."'> [退出]</a>";
            }else{?>
                <a href="<?php echo yii\helpers\Url::to(['member/auth']) ?>">[登录]</a>
            <?php }?>
            
        </span>
        
    </div>
</div><!-- /.contact-row -->
<!-- ============================================================= SEARCH AREA ============================================================= -->
<div class="search-area">
    <form>
        <div class="control-group">
            <input class="search-field" placeholder="Search for item" />

            <ul class="categories-filter animate-dropdown">
                <li class="dropdown">

                    <a class="dropdown-toggle"  data-toggle="dropdown" href="category-grid.html">all categories</a>
                    
                    <ul class="dropdown-menu" role="menu" >
                        <?php foreach($this->params['menu'] as $key => $cate ): ?> 
                        <li role="presentation"><a role="menuitem" tabindex="-1" href=""><?php echo $cate['title'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>

            <a class="search-button" href="#" ></a>    

        </div>
    </form>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->      </div><!-- /.top-search-holder -->

        <div class="col-xs-12 col-md-3 top-cart-row no-margin">
            <div class="top-cart-row-container">
    <div class="wishlist-compare-holder">
        <div class="wishlist ">
            <a href="#"><i class="fa fa-heart"></i> wishlist <span class="value">(21)</span> </a>
        </div>
        <div class="compare">
            <a href="#"><i class="fa fa-exchange"></i> compare <span class="value">(2)</span> </a>
        </div>
    </div>

    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
    <div class="top-cart-holder dropdown animate-dropdown">
        
        <div class="basket">
            
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <div class="basket-item-count">
                    <span class="count">3</span>
                    <img src="assets/images/icon-cart.png" alt="" />
                </div>

                <div class="total-price-basket"> 
                    <span class="lbl">your cart:</span>
                    <span class="total-price">
                        <span class="sign">￥</span><span class="value">0,00</span>
                    </span>
                </div>
            </a>

            <ul class="dropdown-menu">
                <?php foreach($this->params['carts'] as $v): ?>
                <li>
                    <div class="basket-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin text-center">
                                <div class="thumb">
                                    <img alt="" src="http://<?php echo $v->product->cover ?>-coversmall" />
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <div class="title"><?php echo $v->product->title ?></div>
                                <div class="price"><?php echo $v->product->saleprice ?></div>
                            </div>
                        </div>
                        <a class="close-btn" href="#"></a>
                    </div>
                </li>
            <?php endforeach; ?>


                <li class="checkout">
                    <div class="basket-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <a href="<?php echo yii\helpers\Url::to(['cart/index']) ?>" class="le-button inverse">View cart</a>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <a href="checkout" class="le-button">Checkout</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div><!-- /.basket -->
    </div><!-- /.top-cart-holder -->
</div><!-- /.top-cart-row-container -->
<!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->       </div><!-- /.top-cart-row -->

    </div><!-- /.container -->
    
    <!-- ========================================= NAVIGATION ========================================= -->
<nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
    <div class="container">
        <div class="yamm navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div><!-- /.navbar-header -->
            <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
                <ul class="nav navbar-nav">
                
                    
					<?php foreach($this->params['menu'] as $key => $cate ): ?> 
                    <li class="dropdown">
                        <a href="<?php echo yii\helpers\Url::to(['index/index','cateid'=>$cate['cateid']]) ?>" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><?php echo $cate['title'] ?></a>
                        <ul class="dropdown-menu">
                        	<?php foreach($cate['children'] as $child ): ?>
                            <li><a href="<?php echo yii\helpers\Url::to(['product/index','cateid'=>$child['cateid']]) ?>"><?php echo $child['title'] ?></a></li>
                        	<?php endforeach; ?>
                        </ul>
                    </li>
                    <?php endforeach?>
                   
                   
             		<li class="dropdown">
                        <a href="<?php echo yii\helpers\Url::to(['index/index']) ?>"  >返回首页</a>
                       
                    </li>



                </ul><!-- /.navbar-nav -->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.navbar -->
    </div><!-- /.container -->
</nav><!-- /.megamenu-vertical -->
<!-- ========================================= NAVIGATION : END ========================================= -->
    
</header>

<?php echo $content ?>


    <footer id="footer" class="color-bg">
    
  

    <div class="link-list-row">
        <div class="container no-padding">
            <div class="col-xs-12 col-md-12 ">
                <!-- ============================================================= CONTACT INFO ============================================================= -->
<div class="contact-info">
    
    
    <p class="regular-bold"> Feel free to contact us via phone,email or just send us mail.</p>
    
    <p>
        17 Princess Road, London, Greater London NW1 8JR, UK
        1-888-8MEDIA (1-888-892-9953)
    </p>
    
    <div class="social-icons">
        <h3>Get in touch</h3>
        <ul>
            <li><a href="http://facebook.com/transvelo" class="fa fa-facebook"></a></li>
            <li><a href="#" class="fa fa-twitter"></a></li>
            <li><a href="#" class="fa fa-pinterest"></a></li>
            <li><a href="#" class="fa fa-linkedin"></a></li>
            <li><a href="#" class="fa fa-stumbleupon"></a></li>
            <li><a href="#" class="fa fa-dribbble"></a></li>
            <li><a href="#" class="fa fa-vk"></a></li>
        </ul>
    </div><!-- /.social-icons -->

</div>
<!-- ============================================================= CONTACT INFO : END ============================================================= -->            </div>

            <div class="col-xs-12 col-md-8 no-margin">
                <!-- ============================================================= LINKS FOOTER ============================================================= -->





<!-- ============================================================= LINKS FOOTER : END ============================================================= -->            </div>
        </div><!-- /.container -->
    </div><!-- /.link-list-row -->

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="copyright">
                    &copy; <a href="index.html">Media Center</a> - all rights reserved
                </div><!-- /.copyright -->
            </div>
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="payment-methods ">
                    <ul>
                        <li><img alt="" src="assets/images/payments/payment-visa.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-master.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-paypal.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-skrill.png"></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->

</footer><!-- /#footer -->
<!-- ============================================================= FOOTER : END ============================================================= -->   </div><!-- /.wrapper -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/gmap3.min.js"></script>
    <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/css_browser_selector.min.js"></script>
    <script src="assets/js/echo.min.js"></script>
    <script src="assets/js/jquery.easing-1.3.min.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.raty.min.js"></script>
    <script src="assets/js/jquery.prettyPhoto.min.js"></script>
    <script src="assets/js/jquery.customSelect.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/scripts.js"></script>

   



</body>
</html>