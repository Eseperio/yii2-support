<?php
/**
 * SupportAsset
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */


namespace hexa\yiisupport;

use yii\web\AssetBundle;

/**
 * Class SupportAsset
 */
class SupportAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@yiisupport/assets';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/support.css'
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