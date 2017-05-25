<?php

namespace hexa\yiisupport;

use yii\web\AssetBundle;

class CommentAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@yiisupport/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/comment.js',
    ];

    public $css = [
        'css/comment.css'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset'
    ];
}
