<?php

namespace hexa\yiisupport\models;

use hexa\yiisupport\db\ActiveRecord;
use hexa\yiisupport\db\TicketQuery;
use yii\behaviors\BlameableBehavior;
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
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created_by'  => \Yii::t('app', 'Author'),
            'id'          => \Yii::t('app', 'ID'),
            'subject'     => \Yii::t('app', 'Subject'),
            'content'     => \Yii::t('app', 'Content'),
            'status_id'   => \Yii::t('app', 'Ticket Status'),
            'priority_id' => \Yii::t('app', 'Ticket Priority'),
            'category_id' => \Yii::t('app', 'Ticket Category'),
            'created_at'  => \Yii::t('app', 'Created At'),
            'updated_at'  => \Yii::t('app', 'Updated At'),
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
