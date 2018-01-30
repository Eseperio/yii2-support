<?php

namespace hexaua\yiisupport\widgets;

use hexaua\yiisupport\CommentAsset;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * @property mixed formId
 * @property array clientOptions
 */
class Comments extends Widget
{
    /**
     * @var string encrypted entity key from params: entity, entityId, relatedTo
     */
    public $hash;

    /**
     * @var int
     */
    public $ticketId;

    /**
     * @var string pjax container id
     */
    public $containerId;

    /**
     * Generate author name from template.
     * @var string
     * @see Comment::resolveAuthorSignature()
     */
    public $authorNameTemplate = "{name} {email}";

    /**
     * @var string
     */
    public $commentClass = 'hexaua\yiisupport\models\Comment';

    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $formOptions = ['enctype' => 'multipart/form-data'];

    /**
     * @var array comment widget client options
     */
    public $clientOptions = [];

    /**
     * @var ActiveRecord[]
     */
    public $comments = [];

    /**
     * @inheritdoc
     */
    public static $autoIdPrefix = 'comment-pjax-container';

    /**
     * Default form options.
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    protected $defaultFormOptions = [
        'options'          => [
            'id'    => 'comment-form',
            'class' => 'comment-box'
        ],
        'action'           => ['create'],
        'validateOnChange' => false,
        'validateOnBlur'   => false
    ];

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if (empty($this->ticketId)) {
            throw new InvalidConfigException('The "ticketId" property must be set.');
        }

        if (empty($this->containerId)) {
            $this->containerId = $this->getId();
        }

        $this->formOptions = ArrayHelper::merge($this->formOptions, $this->defaultFormOptions);

        $this->registerAssets();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $model = \Yii::createObject([
            'class'     => $this->commentClass,
            'ticket_id' => $this->ticketId
        ]);

        return $this->render('index', [
            'model'              => $model,
            'comments'           => $this->comments,
            'containerId'        => $this->containerId,
            'formOptions'        => $this->formOptions,
            'hash'               => $this->hash,
            'authorNameTemplate' => $this->authorNameTemplate
        ]);
    }

    /**
     * Register assets
     */
    protected function registerAssets()
    {
        $formId  = ArrayHelper::getValue($this->formOptions, 'options.id', 'comment-form');
        $options = ArrayHelper::merge([
            'pjaxContainerId' => "#{$this->containerId}",
            'formSelector'    => "#{$formId}",
        ], $this->clientOptions);

        $options = Json::encode($options);

        $this->getView()->registerAssetBundle(CommentAsset::className());
        $this->getView()->registerJs("jQuery('#{$formId}').comment({$options})");
    }
}
