<?php 
use app\assets\AdminAsset;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
AdminAsset::register($this);
$this->beginPage();
?>

<!DOCTYPE html>
<html>
<head>
    <title>慕课商城 - 后台管理 - <?php echo $this->title ?></title>
    <?php $this->head() ?>
    <?php $this->registerMetaTag(['name'=>'viewport','content'=>'width=device-width, initial-scale=1.0']) ?>
    <?php $this->registerMetaTag(['http-equiv'=>'Content-Type','content'=>'text/html; charset=utf-8']) ?>
   
</head>
<?php $this->beginBody() ?>
<body>
   
    <!-- navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="brand" href="index.html" style="font-weight:700;font-family:Microsoft Yahei">慕课商城 - 后台管理</a>

            <ul class="nav pull-right">                
                <li class="hidden-phone">
                    <input class="search" type="text" />
                </li>
                <li class="notification-dropdown hidden-phone">
                    <a href="#" class="trigger">
                        <i class="icon-warning-sign"></i>
                        <span class="count">6</span>
                    </a>
                    <div class="pop-dialog">
                        <div class="pointer right">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div>
                        <div class="body">
                            <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>
                            <div class="notifications">
                                <h3>你有 6 个新通知</h3>
                                <a href="#" class="item">
                                    <i class="icon-signin"></i> 新用户注册
                                    <span class="time"><i class="icon-time"></i> 13 分钟前.</span>
                                </a>
                                <a href="#" class="item">
                                    <i class="icon-signin"></i> 新用户注册
                                    <span class="time"><i class="icon-time"></i> 18 分钟前.</span>
                                </a>
                                <a href="#" class="item">
                                    <i class="icon-signin"></i> 新用户注册
                                    <span class="time"><i class="icon-time"></i> 49 分钟前.</span>
                                </a>
                                <a href="#" class="item">
                                    <i class="icon-download-alt"></i> 新订单
                                    <span class="time"><i class="icon-time"></i> 1 天前.</span>
                                </a>
                                <div class="footer">
                                    <a href="#" class="logout">查看所有通知</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                
                <li class="notification-dropdown hidden-phone">
                    <a href="#" class="trigger">
                        <i class="icon-envelope-alt"></i>
                    </a>
                    <div class="pop-dialog">
                        <div class="pointer right">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div>
                        <div class="body">
                            <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>
                            <div class="messages">
                                <a href="#" class="item">
                                    <img src="admin/img/contact-img.png" class="display" />
                                    <div class="name">Alejandra Galván</div>
                                    <div class="msg">
                                        There are many variations of available, but the majority have suffered alterations.
                                    </div>
                                    <span class="time"><i class="icon-time"></i> 13 min.</span>
                                </a>
                                <a href="#" class="item">
                                    <img src="admin/img/contact-img2.png" class="display" />
                                    <div class="name">Alejandra Galván</div>
                                    <div class="msg">
                                        There are many variations of available, have suffered alterations.
                                    </div>
                                    <span class="time"><i class="icon-time"></i> 26 min.</span>
                                </a>
                                <a href="#" class="item last">
                                    <img src="admin/img/contact-img.png" class="display" />
                                    <div class="name">Alejandra Galván</div>
                                    <div class="msg">
                                        There are many variations of available, but the majority have suffered alterations.
                                    </div>
                                    <span class="time"><i class="icon-time"></i> 48 min.</span>
                                </a>
                                <div class="footer">
                                    <a href="#" class="logout">View all messages</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
                        账户管理
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                    <li><a href="<?php echo yii\helpers\Url::to(['manage/changeemail']) ?>">个人信息管理</a></li>
                    <li><a href="<?php echo yii\helpers\Url::to(['manage/changepass']); ?>">修改密码</a></li>
                        <li><a href="#">订单管理</a></li>
                    </ul>
                </li>
                <li class="settings hidden-phone">
                    <a href="personal-info.html" role="button">
                        <i class="icon-cog"></i>
                    </a>
                </li>
                <li class="settings hidden-phone">
                <a href="<?php echo yii\helpers\Url::to(['public/logout']) ?>" role="button">
                        <i class="icon-share-alt"></i>
                    </a>
                </li>
            </ul>            
        </div>
    </div>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a href="<?php echo Url::to(['default/index']) ?>">
                    <i class="icon-home"></i>
                    <span>后台首页</span>
                </a>
            </li>            
            <li>
                <a href="chart-showcase.html">
                    <i class="icon-signal"></i>
                    <span>统计</span>
                </a>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-user"></i>
                    <span>管理员管理</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                <li><a href="<?php echo yii\helpers\Url::to(['manage/managers']); ?>">管理员列表</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['manage/reg']); ?>">加入新管理员</a></li>
                </ul>
            </li>

            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-group"></i>
                    <span>用户管理</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                <li><a href="<?php echo yii\helpers\Url::to(['user/users']); ?>">用户列表</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['user/reg']); ?>">加入新用户</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-list"></i>
                    <span>分类管理</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                <li><a href="<?php echo yii\helpers\Url::to(['category/list']); ?>">分类列表</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['category/add']); ?>">加入分类</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-glass"></i>
                    <span>商品管理</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                <li><a href="<?php echo yii\helpers\Url::to(['product/products']); ?>">商品列表</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['product/add']); ?>">添加商品</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-edit"></i>
                    <span>订单管理</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                <li><a href="<?php echo yii\helpers\Url::to(['order/orders']); ?>">订单列表</a></li>
                </ul>
            </li>
            
             <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-group"></i>
                    <span>权限管理</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                <li><a href="<?php echo yii\helpers\Url::to(['rbac/roles']); ?>">用户列表</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['rbac/create-role']); ?>">添加角色</a></li>
                </ul>
            </li>
          
            <li>
                <a href="tables.html">
                    <i class="icon-th-large"></i>
                    <span>表格</span>
                </a>
            </li>
            
            <li>
                <a href="personal-info.html">
                    <i class="icon-cog"></i>
                    <span>我的信息</span>
                </a>
            </li>
            
        </ul>
    </div>
    <!-- end sidebar -->
     
    <?php echo $content ; ?>
    

    <script type="text/javascript">
        /*$(function () {

            // jQuery Knobs
            $(".knob").knob();



            // jQuery UI Sliders
            $(".slider-sample1").slider({
                value: 100,
                min: 1,
                max: 500
            });
            $(".slider-sample2").slider({
                range: "min",
                value: 130,
                min: 1,
                max: 500
            });
            $(".slider-sample3").slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 40, 170 ],
            });

            

            // jQuery Flot Chart
            var visits = [[1, 50], [2, 40], [3, 45], [4, 23],[5, 55],[6, 65],[7, 61],[8, 70],[9, 65],[10, 75],[11, 57],[12, 59]];
            var visitors = [[1, 25], [2, 50], [3, 23], [4, 48],[5, 38],[6, 40],[7, 47],[8, 55],[9, 43],[10,50],[11,47],[12, 39]];

            var plot = $.plot($("#statsChart"),
                [ { data: visits, label: "注册量"},
                 { data: visitors, label: "访客量" }], {
                    series: {
                        lines: { show: true,
                                lineWidth: 1,
                                fill: true, 
                                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                             },
                        points: { show: true, 
                                 lineWidth: 2,
                                 radius: 3
                             },
                        shadowSize: 0,
                        stack: true
                    },
                    grid: { hoverable: true, 
                           clickable: true, 
                           tickColor: "#f9f9f9",
                           borderWidth: 0
                        },
                    legend: {
                            // show: false
                            labelBoxBorderColor: "#fff"
                        },  
                    colors: ["#a7b5c5", "#30a0eb"],
                    xaxis: {
                        ticks: [[1, "一月"], [2, "二月"], [3, "三月"], [4,"四月"], [5,"五月"], [6,"六月"], 
                               [7,"七月"], [8,"八月"], [9,"九月"], [10,"十月"], [11,"十一月"], [12,"十二月"]],
                        font: {
                            size: 12,
                            family: "Open Sans, Arial",
                            variant: "small-caps",
                            color: "#697695"
                        }
                    },
                    yaxis: {
                        ticks:3, 
                        tickDecimals: 0,
                        font: {size:12, color: "#9da3a9"}
                    }
                 });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });*/
       /* $(".wysihtml5").wysihtml5({
            "font-styles": false
        });
        $("#addpic").click(function(){
            var pic = $("#product-pics").clone();
            pic.attr("style", "margin-left:120px");
            $("#product-pics").parent().append(pic);
        });*/

    </script>


</body>
<?php $this->endBody() ?>
<?php if(isset($this->blocks['viewJs'])): ?>
    <?php echo $this->blocks['viewJs'] ?>
<?php endif; ?>
<script type="text/javascript">
    $(".wysihtml5").wysihtml5({
            "font-styles": false
        });
        $("#addpic").click(function(){
            var pic = $("#product-pics").clone();
            pic.attr("style", "margin-left:120px");
            $("#product-pics").parent().append(pic);
        });
</script>
</html>
<?php $this->endPage() ?>

