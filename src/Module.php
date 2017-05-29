<?php

namespace hexa\yiisupport;

use yii\base\BootstrapInterface;
use yii\console\Application;
use yii\helpers\ArrayHelper;

/**
 * Class Module
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'hexa\yiisupport\controllers';

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
