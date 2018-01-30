<?php

namespace hexaua\yiisupport\models;

use hexaua\yiisupport\db\CommentQuery;
use hexaua\yiisupport\traits\DownloadableTrait;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "ticket_comment".
 *
 * @property integer           $id
 * @property string            $content
 * @property string            $file
 * @property integer           $ticket_id
 * @property integer           $created_by
 * @property string            $created_at
 * @property string            $updated_at
 *
 * @property Ticket            $ticket
 * @property IdentityInterface $user   Ticket owner.
 * @property IdentityInterface $author Comment author.
 */
class Comment extends ActiveRecord
{
    use DownloadableTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ticket_comment}}';
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
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'ticket_id'], 'required'],
            [['content'], 'string', 'max' => 1000],
            [['ticket_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [
                ['ticket_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Ticket::className(),
                'targetAttribute' => ['ticket_id' => 'id'],
            ],
            [
                'created_by',
                'exist',
                'targetClass'     => \Yii::$app->user->identityClass,
                'targetAttribute' => 'id'
            ],
            [
                '!file',
                'file',
                'checkExtensionByMimeType' => false,
                'extensions' => \Yii::$app->controller->module->extensions,
                'wrongExtension' => 'Extension of filename "{file}" is not allowed'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => \Yii::t('support', 'ID'),
            'content'    => \Yii::t('support', 'Content'),
            'ticket_id'  => \Yii::t('support', 'Ticket'),
            'created_at' => \Yii::t('support', 'Created At'),
            'updated_at' => \Yii::t('support', 'Updated At'),
            'file'       => \Yii::t('support', 'Add attachment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(\Yii::$app->user->identityClass, ['id' => 'created_by']);
    }

    /**
     * @inheritdoc
     */
    public function getCommentsCount()
    {
        $query = static::find()->byTicketId($this->ticket_id);

        return $query->count();
    }

    /**
     * Is it ticket author comment or no.
     * @return bool
     */
    public function isByAuthor()
    {
        return $this->created_by === $this->ticket->created_by;
    }

    /**
     * Resolve author name. Parse template and selecting from the template user properties.
     *
     * @param string $template
     *
     * @return string|null
     */
    public function resolveAuthorSignature($template)
    {
        $author = preg_replace_callback("/{\\w+}/", function ($matches) {

            list($property) = $matches;

            $property = str_replace(['{', '}'], '', $property);
            if (isset($this->author->{$property})) {
                return $this->author->{$property};
            }

            return null;
        }, $template);

        return $author;
    }

    /**
     * @param bool  $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            return \Yii::$app->controller->module->onCommentCreate($this);
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     * @return CommentQuery
     */
    public static function find()
    {
        return (new CommentQuery(get_called_class()))->alias(static::getAlias());
    }
}
