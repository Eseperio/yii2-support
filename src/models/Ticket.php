<?php

namespace modules\support\models;

use hexa\yiisupport\db\ActiveRecord;
use hexa\yiisupport\db\TicketQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "ticket".
 *
 * @property integer         $id
 * @property string          $subject
 * @property string          $content
 * @property integer         $status_id
 * @property integer         $priority_id
 * @property integer         $category_id
 * @property string          $created_at
 * @property string          $updated_at
 *
 * @property TicketCategory  $category
 * @property TicketPriority  $priority
 * @property TicketStatus    $status
 * @property TicketComment[] $comments
 */
class Ticket extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'client_id',
            'site_id',
            'subject',
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
                    'client_id',
                    'priority_id',
                    'category_id',
                    'status_id',
                    'subject',
                    'content'
                ],
                'required'
            ],
            [['content'], 'string'],
            [['status_id', 'priority_id', 'category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['subject'], 'string', 'max' => 255],
            [
                ['category_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => TicketCategory::className(),
                'targetAttribute' => ['category_id' => 'id']
            ],
            [
                ['priority_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => TicketPriority::className(),
                'targetAttribute' => ['priority_id' => 'id']
            ],
            [
                ['status_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => TicketStatus::className(),
                'targetAttribute' => ['status_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'subject'     => 'Subject',
            'content'     => 'Content',
            'status_id'   => 'Ticket Status',
            'priority_id' => 'Ticket Priority',
            'category_id' => 'Ticket Category',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
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
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TicketCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(TicketPriority::className(), ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TicketStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(TicketComment::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return TicketQuery
     */
    public static function find()
    {
        return new TicketQuery(get_called_class());
    }
}
