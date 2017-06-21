<?php
/**
 * ActiveRecord
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\models;

use hexa\yiisupport\db\ActiveQuery;
use yii\db\ActiveRecord as BaseActiveRecord;

/**
 * Class ActiveRecord
 */
class ActiveRecord extends BaseActiveRecord
{
    /**
     * Make alias for table. Use first symbol of class.
     * @return string
     */
    public static function getAlias()
    {
        $className = (new \ReflectionClass(get_called_class()))->getShortName();
        $alias     = substr($className, 0, 1);

        return strtoupper($alias);
    }

    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return (new ActiveQuery(get_called_class()))->alias(static::getAlias());
    }

    /**
     * @return array
     */
    public static function getList()
    {
        return static::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
