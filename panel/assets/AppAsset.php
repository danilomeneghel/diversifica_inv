<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace panel\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/panel.css',
        'css/font-awesome.css',
        'css/ionicons.min.css',
        'css/skins/skin-green.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.qrcode.min.js',
        'js/app.min.js',
        'plugins/fastclick/fastclick.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'js/demo.js',
        'js/dynamicform-wrapper.js',
        'js/modal-notice.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
