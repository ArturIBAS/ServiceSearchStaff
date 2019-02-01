<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    "myAssets/css/bootstrap.min.css",
    "myAssets/css/font-awesome.min.css",
    "myAssets/css/animate.min.css",
    "myAssets/css/owl.carousel.css",
    "myAssets/css/owl.theme.css",
    "myAssets/css/owl.transitions.css",
    "myAssets/css/style.css",
    "myAssets/css/responsive.css",
    ];
    public $js = [
    //"myAssets/js/jquery-1.11.3.min.js",
    "myAssets/js/bootstrap.min.js",
    "myAssets/js/owl.carousel.min.js",
    "myAssets/js/jquery.stickit.min.js",
    "myAssets/js/menu.js",
    "myAssets/js/scripts.js",
    ];
    public $depends = [
    ];
}
