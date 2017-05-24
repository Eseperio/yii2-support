<?php

namespace hexa\yiisupport;

use yii\web\AssetBundle;

class GoogleChartAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@yiisupport/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'https://www.google.com/jsapi',
        'js/chart.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
