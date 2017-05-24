<?php

namespace modules\support\models;

use hexa\yiisupport\db\ActiveRecord;
use hexa\yiisupport\db\TicketQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "ticket_comment".
 *
 * @property integer $id
 * @property string  $content
 * @property integer $ticket_id
 * @property string  $created_at
 * @property string  $updated_at
 *
 * @property Ticket  $ticket
 */
class TicketComment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_comment';
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
     * @inheritdoc
     * @return TicketQuery
     */
    public static function find()
    {
        return new TicketQuery(get_called_class());
    }
}
