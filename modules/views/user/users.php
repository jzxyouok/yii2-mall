<?php
use yii\widgets\LinkPager; 
?>
    

	<!-- main container -->
    <div class="content">
      
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>Users</h3>
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
                                <th class="span4 sortable">
                                    用户名
                                </th>
                                <th class="span3 sortable">
                                    <span class="line"></span>真实姓名
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>昵称
                                </th>
                                <th class="span3 sortable ">
                                    <span class="line"></span>性别
                                </th>
                                <th class="span3 sortable ">
                                    <span class="line"></span>年龄
                                </th>
                                <th class="span3 sortable ">
                                    <span class="line"></span>生日
                                </th>
                                 <th class="span3 sortable align-right">
                                    <span class="line"></span>操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <?php foreach($users as $user): ?>
                        <tr class="first">
                            <td>
                                <img src=" 
                                <?php 
                                    if(!isset($user->avatar)){
                                        echo Yii::$app->params['defaultValue']['avatar'];
                                    }else{
                                        echo $user->avatar;
                                    }
                                ?>
                                  " class="img-circle avatar hidden-phone" />
                                <a href="user-profile.html" class="name"><?php echo $user->username ?></a>
                                <span class="subtext"><?php echo $user->useremail ?></span>
                            </td>
                            <td>
                                <?php echo isset($user->truename) ? $user->truename : '未填写' ?>
                            </td>
                            <td>
                                <?php echo isset($user->nickname) ? $user->nickname : '未填写' ?>
                            </td>
                             <td>
                                <?php echo isset($user->sex) ? $user->sex : '未填写' ?>
                            </td>
                             <td>
                                <?php echo isset($user->age) ?$user->age : '未填写' ?>
                            </td>
                             <td>
                                <?php echo isset($user->birthday) ? $user->birthday : '未填写' ?>
                            </td>
                            <td class="align-right">
                                <a href=" <?php echo yii\helpers\Url::to(['user/del','userid'=>$user->userid]) ?> "><i class="table-delete" ></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        <!-- row -->
                        
                        </tbody>
                    </table>
                </div>
                <div class="pagination pull-right">
                    <ul>
                        <?php echo LinkPager::widget(['pagination'=>$pager,'prevPageLabel'=>'&#8249;','nextPageLabel'=>'&#8250;']) ?>
                       
                    </ul>
                </div>
                <!-- end users table -->
            </div>
        </div>
    </div>
    <!-- end main container -->
