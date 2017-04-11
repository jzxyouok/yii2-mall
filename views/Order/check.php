
<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<section id="checkout-page">
    <div class="container">
        <div class="col-xs-12 no-margin">
            
            <section id="shipping-address">
                <h2 class="border h1">shipping address</h2>
                <form>
                    <div class="row field-row">
                        <div class="col-xs-12" id="user-address" >
                            
                            <?php foreach($address as $v): ?>
                            <input  class="le-checkbox big" name="address" type="radio" value="<?php echo $v['addressid'] ?>" checked   />
                            <a class="simple-link bold" href="javascript:;">
                                收货地址: <?php echo $v['address'].','.$v['company']  ?> ,收件人: <?php echo $v['firstname'].$v['lastname'] ?> 
                                ,邮编: <?php echo $v['postcode'] ?> ,Email: <?php echo $v['email'] ?>,电话号 <?php echo $v['telephone'] ?>
                            </a>
                            <br />
                            <a href="<?php echo yii\helpers\Url::to(['address/del','addressid'=>$v['addressid'] ]) ?>">删除</a>
                            <br />
                            <br />
                        <?php endforeach; ?>
                        <a class="simple-link bold bulid-address" href="javascript:;">添加联系人</a>
                        <?php
                            if(Yii::$app->session->hasFlash('info')){
                                echo Yii::$app->session->getFlash('info');
                            } 
                        ?>
                        </div>
                    </div><!-- /.field-row -->
                </form>
            </section><!-- /#shipping-address -->
            
            <div class="billing-address" style="display: none;">
                <h2 class="border h1">收货地址</h2>
                <?php $form = ActiveForm::begin([
                    'action'=>['address/add']
                ]); ?>
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label>first name*</label>
                            <input class="le-input" name="Address[firstname]"  >
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>last name*</label>
                            <input class="le-input" name="Address[lastname]" >
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div class="col-xs-12">
                            <label>company name</label>
                            <input class="le-input" name="Address[company]" >
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label>address*</label>
                            <input class="le-input" name="address1" data-placeholder="street address" >
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>&nbsp;</label>
                            <input class="le-input" name="address2" data-placeholder="town" >
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label>邮编*</label>
                            <input class="le-input" name="Address[postcode]"  >
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label>email address*</label>
                            <input class="le-input" name="Address[email]" >
                        </div>

                        <div class="col-xs-12 col-sm-4">
                            <label>phone number*</label>
                            <input class="le-input" name="Address[telephone]" >
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div id="create-account" class="col-xs-12">
                        <?php echo Html::submitButton('提交',['class'=>'le-button huge']) ?>
                        </div>
                    </div><!-- /.field-row -->

                <?php ActiveForm::end(); ?>
            </div><!-- /.billing-address -->




            <section id="your-order">
                <h2 class="border h1">your order</h2>
                    
                    <?php foreach($orders as $order): ?>
                    <div class="row no-margin order-item">
                        <div class="col-xs-12 col-sm-1 no-margin">
                            <a href="#" class="qty"><?php echo $order['productnum'] ?> x</a>
                        </div>

                        <div class="col-xs-12 col-sm-9 ">
                             <a href="<?php echo yii\helpers\Url::to(['product/detail', 'productid' => $order['productid']]) ?>" class="thumb-holder">
                                <img class="lazy" alt="" src="http://<?php echo $order['cover'] ?>-picsmall" />
                            </a>
                            <div class="title" >

                                <a href="javascript:;" style="margin-left:100px; line-height: 75px"><?php echo $order['title'] ?> </a>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-2 no-margin">
                            <div class="price">￥<?php echo $order['price']*$order['productnum'] ?></div>
                        </div>
                    </div><!-- /.order-item -->
                    <?php endforeach; ?>

            </section><!-- /#your-order -->
            <?php $form = ActiveForm::begin([
                    'action'=>['order/confirm']
                ]); ?>
            <div id="total-area" class="row no-margin">
                <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                    <div id="subtotal-holder">
                        <ul class="tabled-data inverse-bold no-border">
                            <li>
                                <label>cart subtotal</label>
                                <div class="value ">￥<?php echo $totalprice ?></div>
                            </li>
                            <li>
                                <label>shipping</label>
                                <div class="value">
                                    <div class="radio-group">
                                        <?php foreach($express as $k => $v): ?>
                                        <input class="le-radio" type="radio" name="express" value="<?php echo $k?>" checked>  <div class="radio-label"><?php echo $v ?><br><span class="bold">￥<?php echo $expressPrice[$k] ?></span></div>
                                        <br/>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </li>
                        </ul><!-- /.tabled-data -->

                        <ul id="total-field" class="tabled-data inverse-bold ">
                            <li>
                                <label>order total</label>
                                <div class="value">￥<?php echo $totalprice ?></div>
                            </li>
                        </ul><!-- /.tabled-data -->

                    </div><!-- /#subtotal-holder -->
                </div><!-- /.col -->
            </div><!-- /#total-area -->
             
            <div id="payment-method-options">
                    
                    <div class="payment-method-option">
                        <input class="le-radio" type="radio" name="paymethod" value="alipay" checked>
                        <div class="radio-label bold ">支付宝</div>
                    </div><!-- /.payment-method-option -->
                    
                    <div class="payment-method-option">
                        <input class="le-radio" type="radio" name="paymethod" value="weixin">
                        <div class="radio-label bold ">微信支付</div>
                    </div><!-- /.payment-method-option -->
            </div><!-- /#payment-method-options -->
           
            <div class="place-order-button">
                <input id="pay" type="submit" class="le-button big" value="付款" >
                <?php Html::submitButton('付款',['class'=>'le-button big','id'=>'pay']) ?>
            </div>
            <input type="hidden" class="addressid" name="addressid" value="">
            <input type="hidden" name="orderid" value="<?php echo $orderid ?>">
        <?php ActiveForm::end() ?>
        </div><!-- /.col -->
    </div><!-- /.container -->    
</section><!-- /#checkout-page -->
<script type="text/javascript">
    window.onload= function(){
        $('.bulid-address').click(function(){
            $('.billing-address').slideToggle();
        })

        $('#pay').click(function(){
            var addressid = $('#user-address').find('input:radio:checked').val();
            if(addressid==undefined){
                alert('请选择邮寄地址')
                return false;
            }
            $('.addressid').val(addressid);
        })
    }
</script>
