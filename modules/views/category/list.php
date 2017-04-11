<?php
use yii\widgets\LinkPager; 
?>
    

    <!-- main container -->
    <div class="content">
      
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>商品分类</h3>
                    <div class="span10 pull-right">
                        <input type="text" class="span5 search" placeholder="Type a user's name..." />
                        
                        <!-- custom popup filter -->
                        <!-- styles are located in css/elements.css -->
                        <!-- script that enables this dropdown is located in js/theme.js -->
                        <div class="ui-dropdown">
                            <div class="head" data-toggle="tooltip" title="Click me!">
                                Filter users
                                <i class="arrow-down"></i>
                            </div>  
                            <div class="dialog">
                                <div class="pointer">
                                    <div class="arrow"></div>
                                    <div class="arrow_border"></div>
                                </div>
                                <div class="body">
                                    <p class="title">
                                        Show users where:
                                    </p>
                                    <div class="form">
                                        <select>
                                            <option />Name
                                            <option />Email
                                            <option />Number of orders
                                            <option />Signed up
                                            <option />Last seen
                                        </select>
                                        <select>
                                            <option />is equal to
                                            <option />is not equal to
                                            <option />is greater than
                                            <option />starts with
                                            <option />contains
                                        </select>
                                        <input type="text" />
                                        <a class="btn-flat small">Add filter</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="new-user.html" class="btn-flat success pull-right">
                            <span>&#43;</span>
                            NEW USER
                        </a>
                    </div>
                </div>

                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span2 sortable">
                                    分类ID
                                </th>
                                <th class="span6 sortable">
                                    <span class="line"></span>分类名称
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>操作
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <?php foreach($cates as $cate): ?>
                        <tr class="first">
                            <td>
                                <?php echo $cate['cateid'] ?>
                            </td>
                            <td>
                                <?php echo $cate['title'] ?>
                            </td>
                       
                            <td class="align-right">
                                <?php if($cate['hasChild']==1): ?>
                                <a href="<?php echo yii\helpers\Url::to(['category/list','cateid'=>$cate['cateid']]) ?> ">子栏目</a>
                                <?php else: ?>
                                <a href="<?php echo yii\helpers\Url::to(['product/products','cateid'=>$cate['cateid']]) ?> ">商品</a>
                                <?php endif; ?>
                                <a href=" <?php echo yii\helpers\Url::to(['category/del','cateid'=>$cate['cateid'] ]) ?> ">&nbsp;&nbsp;<i class="table-delete"></i></a>
                                <a href=" <?php echo yii\helpers\Url::to(['category/edit','cateid'=>$cate['cateid'] ]) ?> ">&nbsp;&nbsp;<i class="table-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        <!-- row -->
                        
                        </tbody>
                    </table>
                </div>
                <?php if(Yii::$app->session->hasFlash('info')){
                    echo Yii::$app->session->getFlash('info');
                    } ?>
                <div class="pagination pull-right">
                    <ul>
                        
                       
                    </ul>
                </div>
                <!-- end users table -->
            </div>
        </div>
    </div>
    <!-- end main container -->
