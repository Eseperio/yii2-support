<?php

namespace hexa\yiisupport\models;

use hexa\yiisupport\db\StatusQuery;

/**
 * This is the model class for table "ticket_status".
 *
 * @property integer  $id
 * @property string   $name
 * @property string   $color
 * @property integer  $resolve
 * @property integer  $default
 *
 * @property Ticket[] $tickets
 */
class Status extends ActiveRecord
{
    const STATUS_DEFAULT_RESOLVED = 2;
    const STATUS_DEFAULT          = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ticket_status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => \Yii::t('support', 'ID'),
            'name'  => \Yii::t('support', 'Status'),
            'color' => \Yii::t('support', 'Color'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(
            Ticket::className(),
            ['status_id' => 'id']
        );
    }

    /**
     * Do not allow to delete default status and resolved status.
     * @return bool
     */
    public function beforeDelete()
    {
        return !($this->resolve || $this->default);
    }

    /**
     * @return int|mixed
     */
    public static function resolvedId()
    {
        return static::find()->select('id')->resolved()->scalar();
    }

    /**
     * @return mixed
     */
    public static function defaultId()
    {
        return static::find()->select('id')->byDefault()->scalar();
    }

    /**
     * @return StatusQuery
     */
    public static function find()
    {
        return (new StatusQuery(get_called_class()))->alias(static::getAlias());
    }
}
