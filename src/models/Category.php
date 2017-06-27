<?php

namespace hexa\yiisupport\models;

use hexa\yiisupport\db\ActiveQuery;

/**
 * This is the model class for table "ticket_category".
 *
 * @property integer  $id
 * @property string   $name
 * @property string   $color
 *
 * @property Ticket[] $tickets
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ticket_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
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
            'name'  => \Yii::t('support', 'Category'),
            'color' => \Yii::t('support', 'Color'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['category_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return (new ActiveQuery(get_called_class()))->alias(static::getAlias());
    }
}
