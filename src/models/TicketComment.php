<?php

namespace hexa\yiisupport\models;

use hexa\yiisupport\db\ActiveRecord;
use hexa\yiisupport\db\TicketCommentQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "ticket_comment".
 *
 * @property integer           $id
 * @property string            $content
 * @property integer           $ticket_id
 * @property string            $created_at
 * @property string            $updated_at
 *
 * @property Ticket            $ticket
 * @property IdentityInterface $user
 */
class TicketComment extends ActiveRecord
{
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
            [['content'], 'string'],
            [['ticket_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [
                ['ticket_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Ticket::className(),
                'targetAttribute' => ['ticket_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'content'    => 'Content',
            'ticket_id'  => 'Ticket',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * @inheritdoc
     */
    public function getCommentsCount()
    {
        $query = static::find()->byTicketId($this->ticket_id);

        return $query->count();
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
            if (isset($this->ticket->user->{$property})) {
                return $this->ticket->user->{$property};
            }

            return null;
        }, $template);

        return $author;
    }

    /**
     * @inheritdoc
     * @return TicketCommentQuery
     */
    public static function find()
    {
        return new TicketCommentQuery(get_called_class());
    }
}
