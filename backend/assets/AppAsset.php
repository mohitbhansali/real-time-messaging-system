<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/bootstrap/bootstrap.min.css',
        'plugins/font-awesome/font-awesome.min.css',
        'plugins/morris/morris.css',
        'plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'plugins/datepicker/datepicker3.css',
        'plugins/daterangepicker/daterangepicker-bs3.css',
        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'css/AdminLTE.css',
        'css/skin-blue.css',
        'plugins/iCheck/square/blue.css',
    ];
    public $js = [
        'plugins/jQueryUI/jquery-ui-1.11.1.min.js',
        'plugins/bootstrap/bootstrap.min.js',
        'plugins/fastclick/fastclick.min.js',
        'plugins/morris/morris.min.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/datepicker/bootstrap-datepicker.js',
        'plugins/iCheck/icheck.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/chartjs/Chart.min.js',
        'js/app.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
