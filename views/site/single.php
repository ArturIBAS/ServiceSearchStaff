<?php
use app\models\Image;
use app\models\Category;
//use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\Resume;
use app\models\ResumeSearch;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<?php

/* @var $this yii\web\View */

$this->title = 'SearchStaff';
?>

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">


                    <article class="post">
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h2><a href="<?= Url::toRoute(['site/category', 'id'=>$resume->category->id]);?>"><?= $resume->category->title ?></a></h2>

                                <h3 class="entry-title"><a href="<?= Url::toRoute(['site/view', 'id'=>$resume->id]);?>"><?= $resume->surname.' '.$resume->name.' '.$resume->patronymic?></a></h3>


                            </header>
                            <div class="entry-content">
                                <p>О себе: <?= $resume->text ?></p>
                                <br>
                                <br>
                                <p>Телефон: <?= $resume->phone ?></p>
                                <p>Почта: <?= $resume->email ?></p>
                                <br>
                            </div>

                            <span class="entry-content">Фотография диплома(сертификата):</span>
                            <div class="post-thumb">
                                <a href="<?= Url::toRoute(['site/view', 'id'=>$resume->id]);?>"><img src="<?=$resume->getImage();?>" alt="Error loading pictures"></a>
                            </div>

                            <div class="social-share">
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>





            </div>
            <div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">

                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Categories</h3>
                        <ul>
                            <?php foreach($categories as $category):?>
                                <li>
                                    <a href="<?= Url::toRoute(['site/category', 'id'=>$category->id]);?>"><?=$category->title?></a>
                                    <span class="post-count pull-right">(<?=$category->getResumes()->count()?>)</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->

