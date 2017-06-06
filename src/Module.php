<?php

namespace hexa\yiisupport;

use hexa\yiisupport\events\CommentEvent;
use hexa\yiisupport\helpers\Config;
use hexa\yiisupport\interfaces\ConfigInterface;
use hexa\yiisupport\models\Comment;
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
    const EVENT_AFTER_COMMENT_CREATE = 'afterCommentCreate';

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
     * Url to upload folder.
     * @var string
     */
    public $uploadUrl = '@web/uploads/support';

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
     * Retrieves value from module "params".
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
     *
     * @return string
     * @throws InvalidConfigException
     */
    public function getSaveDir()
    {
        $path = Yii::getAlias($this->uploadDir);
        if (!file_exists($path)) {
            throw new InvalidConfigException('Invalid config $uploadDir');
        }

        if (FileHelper::createDirectory($path . DIRECTORY_SEPARATOR, 0777)) {
            return $path . DIRECTORY_SEPARATOR;
        }

        throw new InvalidConfigException('$uploadDir is not writable');
    }

    /**
     * @param string $name
     *
     * @return string
     * @throws InvalidConfigException
     */
    public function getPath($name)
    {
        return $this->getSaveDir() . DIRECTORY_SEPARATOR . $name;
    }

    /**
     * Return url to file.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getUrl($name)
    {
        if (is_callable($this->uploadUrl)) {
            return call_user_func($this->uploadUrl, $name);
        }

        return Url::to($this->uploadUrl . '/' . $this->getOwnerPath() . '/' . $name);
    }

    /**
     * Triggers event after comment create.
     *
     * @param Comment $model
     */
    public function onCommentCreate(Comment $model)
    {
        $this->trigger(static::EVENT_AFTER_COMMENT_CREATE, new CommentEvent(['sender' => $model]));
    }
}
