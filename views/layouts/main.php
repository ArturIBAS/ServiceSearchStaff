<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\User;
use app\assets\MyAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\IdentityInterface;

MyAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon icon -->
    <link rel="shortcut icon" href="myAssets/images/index.html">

    <title>Treasure</title>

    <!-- common css -->
    <link rel="stylesheet" href="myAssets/css/bootstrap.min.css">
    <link rel="stylesheet" href="myAssets/css/font-awesome.min.css">
    <link rel="stylesheet" href="myAssets/css/animate.min.css">
    <link rel="stylesheet" href="myAssets/css/owl.carousel.css">
    <link rel="stylesheet" href="myAssets/css/owl.theme.css">
    <link rel="stylesheet" href="myAssets/css/owl.transitions.css">
    <link rel="stylesheet" href="myAssets/style.css">
    <link rel="stylesheet" href="myAssets/css/responsive.css">

    <!-- HTML5 shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.js"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="myAssets/images/favicon.png">

</head>

<body>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Url::toRoute('index');?>"><img src="myAssets/images/logoB.jpg" alt=""></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    <li><a data-toggle="dropdown" class="dropdown-toggle" href="<?= Url::toRoute('site/index');?>">Home</a></li>
                    <?php if(!Yii::$app->user->isGuest):?>
                        <li><a href="<?=Url::toRoute(['/resume'])?>">Add resume</a></li>
                    <?php endif; ?>
                    <?php if (!empty(Yii::$app->user->identity->isAdmin)) {
                        if(Yii::$app->user->identity->isAdmin):?>
                            <li><a href="<?=Url::toRoute(['/admin'])?>">Admin menu</a></li>
                        <?php endif;
                    } ?>

                </ul>
                <div class="i_con">
                    <ul class="nav navbar-nav text-uppercase">
                        <?php if(Yii::$app->user->isGuest):?>
                            <li><a href="<?=Url::toRoute(['auth/login'])?>">Login</a></li>
                            <li><a href="<?=Url::toRoute(['auth/signup'])?>">Register</a></li>
                        <?php else: ?>
                            <?= Html::beginForm(['/auth/logout'], 'post')
                                . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->name . ')',
                                ['class'=>'btn btn-link logout', 'style'=>"padding-top:15px;"]
                            )
                                . Html::endForm() ?>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>


<?= $content ?>

<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <aside class="footer-widget">
                    <div class="about-img"><img src="myAssets/images/logoB.jpg" alt=""></div>
                    <div class="about-content">Данный сайт разработан в качестве тестового задания!

                    </div>
                    <div class="address">
                        <h4 class="text-uppercase">contact Info</h4>

                        <a href="https://vk.com/ari__ari_ari" target="_blank">Artur Buriev</a>

                        <p> Phone: +79277367842</p>

                        <a href="mailto:arturburiev@yandex.ru">arturburiev@yandex.ru</a>
                    </div>
                </aside>
            </div>

            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Testimonials</h3>

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!--Indicator-->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>*Какое-то сообщение для посетителя*</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="assets/myAssets/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Artur</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>*Какое-то сообщение для посетителя*</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="assets/myAssets/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Artur</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>*Какое-то сообщение для посетителя*</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="assets/myAssets/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Artur</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>

        </div>
    </div>
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        by <a href="https://vk.com/ari__ari_ari" target="_blank">Artur Buriev</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- js files -->
<script type="text/javascript" src="myAssets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="myAssets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="myAssets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="myAssets/js/jquery.stickit.min.js"></script>
<script type="text/javascript" src="myAssets/js/menu.js"></script>
<script type="text/javascript" src="myAssets/js/scripts.js"></script>
</body>

</html>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
