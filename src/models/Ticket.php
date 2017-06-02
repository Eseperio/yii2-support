<?php

namespace hexa\yiisupport\models;

use hexa\yiisupport\db\TicketQuery;
use hexa\yiisupport\traits\DownloadableTrait;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\UploadedFile as File;

/**
 * This is the model class for table "ticket".
 *
 * @property integer     $id
 * @property string      $subject
 * @property string      $content
 * @property integer     $status_id
 * @property integer     $priority_id
 * @property integer     $category_id
 * @property integer     $created_by
 * @property string      $created_at
 * @property string      $completed_at
 * @property string      $updated_at
 * @property string|File $file
 *
 * @property Category    $category
 * @property Priority    $priority
 * @property Status      $status
 * @property Comment[]   $comments
 */
class Ticket extends ActiveRecord
{
    use DownloadableTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ticket}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'value'              => new Expression('NOW()'),
                'createdAtAttribute' => 'created_at',
            ],
            [
                'class'              => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'subject',
            'created_by',
            'content',
            'status'   => function ($model) {
                return $model->status;
            },
            'priority' => function ($model) {
                return $model->priority;
            },
            'category' => function ($model) {
                return $model->category;
            },
            'comments' => function ($model) {
                return $model->comments;
            },
            'completed_at',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'priority_id',
                    'category_id',
                    'subject',
                    'content'
                ],
                'required'
            ],
            [['content'], 'string', 'min' => 3, 'max' => 1000],
            [['status_id', 'priority_id', 'category_id'], 'integer'],
            ['status_id', 'default', 'value' => Status::defaultId()],
            [
                '!file',
                'file',
                'checkExtensionByMimeType' => true,
                'extensions'               => \Yii::$app->controller->module->extensions,
                'mimeTypes'                => \Yii::$app->controller->module->mimeTypes
            ],
            [['created_at', 'updated_at'], 'safe'],
            [['subject'], 'string', 'min' => 3, 'max' => 255],
            [
                ['category_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Category::className(),
                'targetAttribute' => ['category_id' => 'id']
            ],
            [
                ['priority_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Priority::className(),
                'targetAttribute' => ['priority_id' => 'id']
            ],
            [
                ['status_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Status::className(),
                'targetAttribute' => ['status_id' => 'id']
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created_by'   => \Yii::t('ticket', 'Author'),
            'id'           => \Yii::t('ticket', 'ID'),
            'subject'      => \Yii::t('ticket', 'Subject'),
            'content'      => \Yii::t('ticket', 'Content'),
            'status_id'    => \Yii::t('ticket', 'Status'),
            'priority_id'  => \Yii::t('ticket', 'Priority'),
            'category_id'  => \Yii::t('ticket', 'Category'),
            'completed_at' => \Yii::t('ticket', 'Completed at'),
            'created_at'   => \Yii::t('ticket', 'Created At'),
            'updated_at'   => \Yii::t('ticket', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'category',
            'priority',
            'status',
            'comments'
        ];
    }

    /**
     * @return bool
     */
    public function isResolved()
    {
        return $this->status_id == Status::resolvedId();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\Yii::$app->user->identityClass, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['ticket_id' => 'id'])->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * @param string $secret Secret word.
     *
     * @param array  $params
     *
     * @return string
     */
    public function getHash($secret, $params = [])
    {
        return utf8_encode(\Yii::$app->getSecurity()->encryptByKey(
            Json::encode(ArrayHelper::merge([
                'ticket_id' => $this->id,
            ], $params)),
            $secret
        ));
    }

    /**
     * @param bool $isResolved
     *
     * @return $this
     */
    public function setResolved($isResolved = true)
    {
        $resolvedId = (int)Status::resolvedId();

        if ($isResolved && $resolvedId !== $this->status_id) {
            $this->status_id    = $resolvedId;
            $this->completed_at = new Expression('NOW()');

        } elseif (!$isResolved && $resolvedId === $this->status_id) {
            $this->status_id    = Status::defaultId();
            $this->completed_at = null;
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUploadPath($uploadRoot)
    {
        return $uploadRoot . '/ticket';
    }

    /**
     * @return TicketQuery
     */
    public static function find()
    {
        return (new TicketQuery(get_called_class()))->alias(static::getAlias());
    }
}
