<?php

namespace hexa\yiisupport;

use yii\helpers\ArrayHelper;

/**
 * Class Module
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'hexa\yiisupport\controllers';

    /**
     * @var string Default url for breadcrumb
     */
    public $defaultUrl;

    /**
     * @var string Default url label for breadcrumb
     */
    public $defaultUrlLabel;

    /**
     * @inheritdoc
     * @var string
     */
    public $version = '1.0.0';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        \Yii::setAlias('@yiisupport', __DIR__);
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }

    /**
     * Get param value.
     *
     * @param string|int $key
     * @param mixed      $default
     *
     * @return mixed
     */
    public function param($key, $default = null)
    {
        return ArrayHelper::getValue($this->params, $key, $default);
    }
}
