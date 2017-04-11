<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
	<section id="cart-page">
    <div class="container">
        <!-- ========================================= CONTENT ========================================= -->
        <div class="col-xs-12 col-md-9 items-holder no-margin">
            
          
        <?php $form = ActiveForm::begin([
            'action'=>['order/add']
        ]) ?>

        <?php foreach($data as $k => $product): ?>
           <input type="hidden" name="orderDetail[<?php echo $k ?>][productid]" value="<?php echo $product['productid'] ?>">
           <input type="hidden" name="orderDetail[<?php echo $k ?>][price]" value="<?php echo $product['price'] ?>">
            <div class="row no-margin cart-item">
                <div class="col-xs-12 col-sm-2 no-margin">
                    <a href="#" class="thumb-holder">
                        <img class="lazy" alt="" src="http://<?php echo $product['cover'] ?>-coversmall" />
                    </a>
                </div>

                <div class="col-xs-12 col-sm-5">
                    <div class="title">
                        <a href="#"><?php echo $product['title'] ?> </a>
                    </div>
                    <div class="brand">sony</div>
                </div> 

                <div class="col-xs-12 col-sm-3 no-margin">
                    <div class="quantity">
                        <div class="le-quantity">
                                <a class="minus" href="#reduce"></a>
                                <input class="inputtotal"  name="orderDetail[<?php echo $k ?>][productnum]" readonly="readonly" type="text" value="<?php echo $product['productnum'] ?>" price="<?php echo $product['price'] ?>" cartid="<?php echo $product['cartid'] ?>" />
                                <a class="plus" href="#add"></a>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-2 no-margin">
                    <div class="price">
                        <?php echo $product['price'] ?>
                    </div>
                    <a class="close-btn" cartid="<?php echo $product['cartid'] ?>" href="javascript:;"></a>
                </div>
            </div><!-- /.cart-item -->
        <?php endforeach; ?>
        </div>
        <!-- ========================================= CONTENT : END ========================================= -->

        <!-- ========================================= SIDEBAR ========================================= -->

        <div class="col-xs-12 col-md-3 no-margin sidebar ">
            <div class="widget cart-summary">
                <h1 class="border">shopping cart</h1>
                <div class="body">
                    <ul class="tabled-data no-border inverse-bold">
                        <li>
                            <label>cart subtotal</label>
                            <div class="value pull-right">￥0</div>
                        </li>
                        <li>
                            <label>shipping</label>
                            <div class="value pull-right">free shipping</div>
                        </li>
                    </ul>
                    <ul id="total-price" class="tabled-data inverse-bold no-border">
                        <li>
                            <label>order total</label>
                            <div class="value pull-right total-price">￥<span class="value totalprice">0</span></div>
                        </li>
                    </ul>
                    <div class="buttons-holder">
                        <?php echo Html::submitButton('结算',['class'=>'le-button big']); ?>
                        
                        <a class="simple-link block" href="<?php echo yii\helpers\Url::to(['index/index']) ?>" >continue shopping</a>
                    </div>
                </div>
            </div><!-- /.widget -->
        <?php ActiveForm::end() ?>
            <div id="cupon-widget" class="widget">
                <h1 class="border">使用优惠劵</h1>
                <div class="body">
                    <form>
                        <div class="inline-input">
                            <input data-placeholder="输入优惠码" type="text" />
                            <button class="le-button"  type="submit">Apply</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.widget -->
        </div><!-- /.sidebar -->
        <!-- ========================================= SIDEBAR : END ========================================= -->
    </div>
</section>
<script type="text/javascript">
   (function(){
    var _csrf = "<?= Yii::$app->request->csrfToken ?>"
    function changeTotalPrice(){
        var total = 0;
        $('.inputtotal').each(function(index,obj){
            total+= $(this).attr('price')*$(this).val();
        });
        $('span.totalprice').text(total);
    }
    window.onload = function(){
        changeTotalPrice()
        $('.minus').click(function(){
            var input = $(this).parent().find('input');
            var data = {};
            data.cartid = input.attr('cartid');
            data.productnum = input.val();
            data._csrf = _csrf;
            post(data,changeTotalPrice)
        })
        $('.plus').click(function(){
            var input = $(this).parent().find('input');
            var data = {};
            data.cartid = input.attr('cartid');
            data.productnum = input.val();
            data._csrf = _csrf;
            post(data,changeTotalPrice)
        })
        $('.close-btn').click(function(){
            var url =  "<?php echo yii\helpers\Url::to(['cart/del']) ?>";
            var data = {};
            data.cartid = $(this).attr('cartid');
            data._csrf = _csrf;
            $.post(url,data,function(d){
                if(d==1){
                    window.location.href= "<?php echo yii\helpers\Url::to(['cart/index']) ?>";
                }
            });
        })
    }

    function post(data,callback){
        var url = "<?php echo yii\helpers\Url::to(['cart/editnum']) ?>";
        $.post(url,data,function(d){
            if(d==1){
                callback && callback();
            }
        })
    }
   })()
</script>
