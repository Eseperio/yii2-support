<?php

namespace hexa\yiisupport;

use hexa\yiisupport\helpers\Config;
use hexa\yiisupport\interfaces\ConfigInterface;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;
use yii\console\Application;
use yii\helpers\ArrayHelper;

/**
 * Class Module
 */
class Module extends BaseModule implements BootstrapInterface
{
    /**
     * @var string Admin role
     */
    public $adminRole;

    /**
     * @var string User role
     */
    public $userRole;

    /**
     * @var string
     */
    public $showTitle;

    /**
     * @var string
     */
    public $authorNameTemplate;

    /**
     * @inheritdoc
     * @var string
     */
    public $version = '1.0.0';

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, $config = [])
    {
        $config = ArrayHelper::merge(require(__DIR__ . '/config/main.php'), $config);

        parent::__construct($id, $parent, $config);
    }

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        if ($app instanceof Application) {
            $app->controllerMap[$this->id] = [
                'class'  => 'hexa\yiisupport\console\RbacController',
                'module' => $this,
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        \Yii::setAlias('@yiisupport', __DIR__);
        \Yii::$container->setSingleton(ConfigInterface::class, Config::class, [$this]);
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
