<?php

/* @var $this \yii\web\View */
/* @var $content string */
// Yii::$app->response->redirect(['/mub-admin']);
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Home :: TechInversio | Business Blog</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tech Inversio, Blogging" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<?= Html::csrfMetaTags() ?>
<?php $this->head();?>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header">
<div class="header-top">
    <div class="container">
        <div class="logo">
            <a href="/"><h1>TECH INVERSIO</h1></a>
        </div>
        <div class="search">
            <form>
                <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
                <input type="submit" value="">
            </form>
        </div>
        <div class="social">
            <ul>
                <li><a href="#" class="facebook"> </a></li>
                <li><a href="#" class="facebook twitter"> </a></li>
                <li><a href="#" class="facebook chrome"> </a></li>
                <li><a href="#" class="facebook in"> </a></li>
                <li><a href="#" class="facebook beh"> </a></li>
                <li><a href="#" class="facebook vem"> </a></li>
                <li><a href="#" class="facebook yout"> </a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="head-bottom">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="<?= ($this->params['page'] == 'home') ? 'active' :'' ;?>"><a href="/">Home</a></li>
        <li class="<?= ($this->params['page'] == 'blogs') ? 'active' :'' ;?>"><a href="/blog">Blogs</a></li>
        <li class="dropdown <?= ($this->params['page'] == 'categories') ? 'active' :'' ;?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/blog/search?s=category&sa=bakery">Bakery</a></li>
          </ul>
        </li>
        <li class="<?= ($this->params['page'] == 'contact') ? 'active' :'' ;?>"><a href="#">Contact Us</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>
<!--head-bottom-->
</div>
<?php
    NavBar::begin([
        'brandLabel' => '<div class="logo">
            <a href="index.html"><h1>TECH INVERSIO</h1></a>
        </div>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Blogs', 'url' => ['/blog/index']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    <?= $content ?>
<div class="footer dark-bg">
    <div class="container dark-bg">
        <div class="col-md-4 footer-left">
            <h6>SOME MORE INFORMATION</h6>
            <p>This is the space left to be filled from the the additional comapny Information.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt consectetur adipisicing elit,</p>
        </div>
        <div class="col-md-4 footer-middle">
        <h4>Twitter Feed</h4>
        <div class="mid-btm">
            <p>Consectetur adipisicing</p>
            <p>Sed do eiusmod tempor</p>
            <a href="https://MakeUBig.com/">https://MakeUBig.com/</a>
        </div>
        
            <p>Consectetur adipisicing</p>
            <p>Sed do eiusmod tempor</p>
            <a href="https://MakeUBig.com/">https://MakeUBig.com/</a>
    
        </div>
        <div class="col-md-4 footer-right">
            <h4>Quick Links</h4>
            <li><a href="#">Eiusmod tempor</a></li>
            <li><a href="#">Consectetur </a></li>
            <li><a href="#">Adipisicing elit</a></li>
            <li><a href="#">Eiusmod tempor</a></li>
            <li><a href="#">Consectetur </a></li>
            <li><a href="#">Adipisicing elit</a></li>
        </div>
        <div class="clearfix" style="background: #121212"></div>
    </div>
</div>
<div class="foot-nav">
</div>
<div class="clearfix" style="background: #121212"></div>
<div class="copyright">
    <div class="container">
        <p>© 2016 Business_Blog. All rights reserved | Template by <a href="http://MakeUBig.com/">DoubtsApp</a></p>
    </div>
</div>
<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>
