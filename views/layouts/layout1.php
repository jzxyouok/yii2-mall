<?php 
use app\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;
AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->registerMetaTag(['http-equiv'=>'Content-Type','content'=>'text/html; charset=UTF-8']) ?>
        <?php $this->registerMetaTag(['name'=>'viewport','content'=>'width=device-width, initial-scale=1.0, user-scalable=no']) ?>
        <?php $this->registerMetaTag(['name'=>'description','content'=>''])?>
        <?php $this->registerMetaTag(['name'=>'author','content'=>''])?>
        <?php $this->registerMetaTag(['name'=>'keywords','content'=>'MediaCenter, Template, eCommerce'])?>
        <?php $this->registerMetaTag(['name'=>'robots','content'=>'all'])?>
       

        <title><?php $this->title ?></title>

        <?php $this->head() ?>
    
    </head>
    <?php $this->beginBody() ?>
<body>
    
    <div class="wrapper">
    <?php 
        NavBar::begin([
                'options'=>[
                    'class'=>'top-bar animate-dropdown',
                ]
            ]);
        echo Nav::widget([
            'options'=>[
                'class'=>'navbar-nav navbar-left',
            ],
            'items'=>[
                ['label'=>'首页','url'=>Url::to(['index/index'])],
                ['label'=>'所有分类','url'=>Url::to(['index/index'])],
                ['label'=>'我的购物车','url'=>Url::to(['cart/index'])],
                ['label'=>'我的订单','url'=>Url::to(['order/index'])],
            ]
        ]);

        echo Nav::widget([
            'options'=>[
                'class'=>'navbar-nav navbar-right',
            ],
            'items'=>[
                (!\Yii::$app->user->isGuest)?['label'=>'您好 , 欢迎您回来','url'=>Url::to(['member/logout'])]:'',
                (\Yii::$app->user->isGuest)?['label'=>'注册','url'=>Url::to(['member/auth'])]:'',
                (\Yii::$app->user->isGuest)?['label'=>'登录','url'=>Url::to(['member/auth'])]:'',

            ]
        ]);

        NavBar::end();
    ?>
    

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
            if(!Yii::$app->user->isGuest){
                echo '欢迎 ';
                echo Yii::$app->user->identity->username;
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
 </div><!-- /.wrapper -->


   



</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>