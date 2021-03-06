<?php

use yii\helpers\Html;
use yii\helpers\Url;
$bundle = yiister\gentelella\assets\Asset::register($this);
$this->registerJsFile('/js/custom_mub_backend.js', ['depends' => [yii\web\JqueryAsset::className()]]);
require_once('menu.php');
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title);?></title>
    <?php $this->head() ?>
    <style>
        .left_col {
                    background: #8A0303 !important;
                     height: 100% !important;
                     min-height: 100% !important;
                     position: fixed;
                    }
        body{
            background-color: #F7F7F7 !important;
            
            
        }
        .nav.side-menu>li.current-page, .nav.side-menu>li.active{
            border-right: 5px solid #ffffff !important;
        }
        .nav_title {
            background: #4C4C4C !important; 
        }
        
        .btn-danger {
            background-color: #4c4c4c !important;
            border-color: #4c4c4c !important;
        }
        .btn-success {
    background: #8A0303 !important;
    border: 1px solid #8A0303 !important;
}
.btn-success:hover,
.btn-success:focus,
.btn-success:active,
.btn-success.active,
.open .dropdown-toggle.btn-success {
    background: #8A0303 !important;
}
    </style>
</head>
<body class="nav-md">    
<?php $this->beginBody(); ?>
<div class="container body">
    <div class="main_container">
        <?php if(!Yii::$app->user->isGuest){?>
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view" >
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title"><img src="/images/pngegg.png" width="45px" height="45px" > <span style="font-size:18px;"> Blood Report</span></a>
                </div>
                <div class="clearfix"></div>
                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="/images/user.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2><?= (\Yii::$app->user->isGuest) ? 'Guest' : Yii::$app->user->identity->first_name;?></h2>
                    </div>
                </div>
                <br />
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section" style="padding-top:6em">
                        
                        <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => $menu,
                            ]
                        )
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small" style="display:none;" >
                    <a  style="display:none;" data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a style="display:none;" data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a style="display:none;" data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a style="display:none;" data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="top_nav">
            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="/images/user.jpg" alt=""><?=(Yii::$app->user->identity) ? Yii::$app->user->identity->first_name :'Guest';?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;">Profile</a>
                                </li>
                                <li><a href="<?= Url::to(['/site/logout'])?>" data-method="post" ><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                        <li role="presentation" class="dropdown">
                            <?php if(false){?>
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                    <span class="image">
                                        <img src="http://placehold.it/128x128" alt="Profile Image" />
                                    </span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a href="/">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <?php }?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php }?>
        <div class="<?= (\Yii::$app->user->id) ? 'right_col' : ''?>" role="main">
            <?php if(isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
       <!-- <footer>
            <div class="pull-right">
                <!--<a href="http://doubtapp.localhost/site/login#" rel="nofollow" target="_blank">DoubtsApp</a><br />-->
            <!--</div>
            <div class="clearfix"></div>
        </footer>-->
        <!-- /footer content -->
    </div>


<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
    </div>
<?php $this->endBody(); ?>


</body>
</html>
<?php $this->endPage(); ?>
