

<div id="single-product">
<div class="container" style="padding-top:10px">
<div style="margin-bottom:30px;">

<div style="margin-bottom:30px;">

<?php foreach($orders as $order): ?>

  <div class="trade-order-mainClose">
    <div>
      <table style="width:100%;border-collapse:collapse;border-spacing:0px;">
        <colgroup>
          <col style="width:38%;">
          <col style="width:10%;">
          <col style="width:5%;">
          <col style="width:12%;">
          <col style="width:12%;">
          <col style="width:11%;">
          <col style="width:12%;">
        </colgroup>
        <tbody>
          <tr style="background-color:#F5F5F5;width:100%">
            <td style="padding:10px 20px;text-align:left;">
              <label>
                <input type="checkbox" disabled="" style="margin-right:8px;">
                <strong title="2016-02-17 15:55:26" style="margin-right:8px;font-weight:bold;">
                  <?php echo date("Y-m-d h:i:s",$order->createtime) ?>
                </strong>
              </label>
              <span>
                订单号：
              </span>
              <span>
              </span>
              <span>
                <?php echo $order->expressno ?>
              </span>
            </td>
            
          </tr>
        </tbody>
      </table>
      <table style="width:100%;border-collapse:collapse;border-spacing:0px;">
        <colgroup>
          <col style="width:38%;">
          <col style="width:10%;">
          <col style="width:5%;">
          <col style="width:12%;">
          <col style="width:12%;">
          <col style="width:11%;">
          <col style="width:12%;">
        </colgroup>
        <tbody>
        <?php $i=0; ?>
        <?php foreach($order->products as $product): ?>
          <tr>
            <td style="text-align:left;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:0;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:1px;border-top-style:solid;border-top-color:#E8E8E8;padding-left:20px;" >
              <div style="overflow:hidden;">
                <a class="tp-tag-a" href="" style="float:left;width:27%;margin-right:2%;text-align:center;" target="_blank" >
                  <img src="http://<?php echo $product['cover'] ?>-picsmall" style="border:1px solid  #E8E8E8;max-width:80px;">
                </a>
                <div style="float:left;width:71%;word-wrap:break-word;">
                  <div style="margin:0px;">
                    <a class="tp-tag-a" href="" target="_blank">
                      <span>
                        名称： <?php echo $product['title'] ?>
                        <br>
                        分类:  <?php echo $product['catename']  ?>
                      </span>
                    </a>
                    
                    <span>
                    </span>
                  </div>
                  <div style="margin-top:8px;margin-bottom:0;color:#9C9C9C;">
                    <span style="margin-right:6px;">
                      <!-- <span>
                        颜色分类
                      </span>
                      <span>
                        ：
                      </span>
                      <span>
                        黑色战争机器-海盗
                      </span> -->
                    </span>
                  </div>
                  
                  <span>
                  </span>
                </div>
              </div>
            </td>
            <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:0;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:1px;border-top-style:solid;border-top-color:#E8E8E8;" >
              <div style="font-family:verdana;font-style:normal;">
                <p>
                  <del style="color:#9C9C9C;">
                    <?php echo $product['price']; ?>
                  </del>
                </p>
                <p>
                  <?php echo $product['saleprice'] ?>
                </p>
                <span>
                </span>
                <span>
                </span>
              </div>
            </td>
            <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:0;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:1px;border-top-style:solid;border-top-color:#E8E8E8;" >
              <div>
                <div>
                  数量：
                  <?php echo $product['num'] ?>
                </div>
              </div>
            </td>
           
            <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:1px;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;" >
            </td>
            <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:1px;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;" >
              <?php if($i==0): ?>
              <?php echo $order->amount; ?>
              <br>
              (含运费:<?php echo  Yii::$app->params['expressPrice'][$order->expressid] ?>)
            <?php endif; ?>
            </td>
            <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:0;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:1px;border-top-style:solid;border-top-color:#E8E8E8;" >
              <div>
                <div style="margin-bottom:3px;">
                  <span>
                   <?php if($i==0): ?>
                    <?php if($order->status<=100){ ?>
                      <a class="tp-tag-a" href="javascript:;">
                      <span class="trade-operate-text">
                        待支付
                      </span>
                      </a>
                    <?php }elseif($order->status<=202){?>
                      <span class="trade-operate-text">
                        待发货
                      </span>
                      <br>
                       <br>
                       </a>
                       <a class="tp-tag-a" href="javascript:;">
                      <span class="trade-operate-text">
                        催一下
                      </span>
                      </a>
                    <?php }elseif($order->status==220){?>
                       <a class="tp-tag-a check-express" href="javascript:;" expressid="<?php echo $order->expressno ?>" >
                      <span class="trade-operate-text">
                        已发货，查看物流
                      </span>
                       <div class="expressshow" style="overflow:auto;text-align:left;font-size:12px;width:200px;height:300px;position:absolute;border:1px solid #ccc;padding:15px;background-color:#eee;display: none">快递状态:查修询中...</div>
                      </a>
                      <br>
                      <br>
                      <a href="<?php echo yii\helpers\Url::to(['order/received','orderid'=>$order->orderid]) ?>">确定收货</a>
                      
                    <?php }elseif($order->status==255){?>
                      <span class="trade-operate-text">
                        订单完成
                      </span>
                      <br>
                      <br>
                      <a href="">
                        可以评价了哟^_^
                      </a>
                      
                    <?php }?>
                       
                   
                    <?php endif; ?>
                  </span>
                </div>
              </div>
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
        </tbody>
      </table>
      <div>
      </div>
      
    <?php endforeach; ?>
    </div>
  </div>
</div>
    </div>

<script type="text/javascript">
  window.onload = function(){
    var isOver = false;
    var url = "<?php echo yii\helpers\Url::to(['order/getexpress']) ?>"
    $('.check-express').hover(
        function(){
          var obj = $(this).find('div');
          url = url+'&expressid='+$(this).attr('expressid');
          obj.fadeIn();
          if(isOver==false){
            $.get(url,function(d){
              var str = '';
              if(d.status==400){
                str = '<p>查询失败!</p>';
              }else{
                for(var i =0;i<d.data.length;i++){
                  str+='<p>'+d.data[i].time+' '+d.data[i].context+'</p>';
                }
              } 
              console.log(str);
               isOver = true;
              obj.html(str);
            },'JSON')
          } 
         
          
        }
        ,
        function(){
          var obj = $(this).find('div');
          obj.fadeOut();
        }
      )
  }
</script>