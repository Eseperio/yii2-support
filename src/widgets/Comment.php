<?php

namespace hexa\yiisupport\widgets;

use hexa\yiisupport\CommentAsset;
use hexa\yiisupport\models\TicketComment;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * @property mixed formId
 * @property array clientOptions
 */
class Comment extends Widget
{
    /**
     * @var object
     */
    public $model;

    /**
     * @var string pjax container id
     */
    public $containerId;

    /**
     * @var array comment widget client options
     */
    public $clientOptions = [];

    /**
     * Secret keyword for generate hash string.
     * @var string
     */
    public $secret;

    /**
     * @var string
     */
    public $formId = 'comment-form';

    /**
     * @inheritdoc
     */
    public static $autoIdPrefix = 'comment-pjax-container';

    /**
     * @var string encrypted entity key from params: entity, entityId, relatedTo
     */
    protected $hash;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if (empty($this->model)) {
            throw new InvalidConfigException('The "model" property must be set.');
        }

        if (empty($this->containerId)) {
            $this->containerId = $this->getId();
        }

        $this->hash = $this->generateHash();

        $this->registerAssets();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $model    = \Yii::createObject([
            'class'     => TicketComment::className(),
            'ticket_id' => $this->model->id
        ]);
        $comments = TicketComment::find()->byTicketId($this->model->id)->all();

        return $this->render('index', [
            'comments'    => $comments,
            'model'       => $model,
            'containerId' => $this->containerId,
            'formId'      => $this->formId,
            'hash'        => $this->hash
        ]);
    }

    /**
     * Register assets
     */
    protected function registerAssets()
    {
        $this->clientOptions = [
            'pjaxContainerId' => "#{$this->containerId}",
            'formSelector'    => "#{$this->formId}",
        ];

        $options = Json::encode($this->clientOptions);

        $this->getView()->registerAssetBundle(CommentAsset::className());
        $this->getView()->registerJs("jQuery('#{$this->formId}').comment({$options})");
    }

    /**
     * @return string
     */
    protected function generateHash()
    {
        return utf8_encode(\Yii::$app->getSecurity()->encryptByKey(
            Json::encode([
                'ticket_id' => $this->model->id
            ]),
            'comment'
        ));
    }
}
