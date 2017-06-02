<?php

namespace hexa\yiisupport;

use hexa\yiisupport\helpers\Config;
use hexa\yiisupport\interfaces\ConfigInterface;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\base\Module as BaseModule;
use yii\console\Application;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Url;

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
     * @var string
     */
    public $uploadDir = '@webroot/uploads/support';

    /**
     * @var string
     */
    public $mediaUrl = '/media/get';

    /**
     * On/off action buttons for Ticket.
     * @var array
     */
    public $buttons = [
        'delete'  => true,
        'update'  => true,
        'resolve' => true,
    ];

    /**
     * List of accepted extensions.
     * @var array
     */
    public $extensions = [
        'png',
        'jpg',
        'pdf',
        'doc',
        'docx',
        'ppt',
        'pptx',
        'xls',
        'xlsx'
    ];

    /**
     * List of accepted mime types.
     * @var array
     */
    public $mimeTypes = [
        'image/png',
        'image/jpeg',
        'application/pdf',
        'application/msword',
        'application/vnd.ms-excel',
        'application/xml',
        'application/mspowerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentatio',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

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
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        \Yii::setAlias('@yiisupport', __DIR__);
        \Yii::$container->setSingleton(ConfigInterface::class, Config::class, [$this]);
    }

    /**
     * @inheritdoc
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

    /**
     * Return sub folder for current user.
     * @return int|string
     */
    public function getOwnerPath()
    {
        return Yii::$app->user->isGuest ? 'guest' : Yii::$app->user->id;
    }

    /**
     * Returns path to the upload dir.
     * @throws InvalidConfigException
     */
    public function getUploadDir()
    {
        if (!$path = \Yii::getAlias($this->uploadDir)) {
            throw new InvalidConfigException('Invalid config $uploadDir');
        }

        if (FileHelper::createDirectory($path . DIRECTORY_SEPARATOR . \Yii::$app->user->id, 0777)) {
            return $path . DIRECTORY_SEPARATOR . $this->getOwnerPath();
        }

        throw new InvalidConfigException('$uploadDir is not writable');
    }

    /**
     * @param string $name
     *
     * @return string
     * @throws InvalidConfigException
     */
    public function getMediaPath($name)
    {
        return $this->getUploadDir() . DIRECTORY_SEPARATOR . $name;
    }

    /**
     * Return url for href or src attributes.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getMediaUrl($name)
    {
        return Url::to([$this->mediaUrl, 'name' => $name]);
    }
}
