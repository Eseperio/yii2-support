<?php
/**
 * ActiveRecord
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\db;

use hexa\yiisupport\interfaces\ConfigInterface;
use yii\db\ActiveRecord as BaseActiveRecord;

/**
 * Class ActiveRecord
 */
class ActiveRecord extends BaseActiveRecord
{
    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }

    /**
     * @return array
     */
    public static function list()
    {
        return static::find()->select(['name', 'id'])->indexBy('id')->column();
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function getConfig($key, $default = null)
    {
        return \Yii::$container->get(ConfigInterface::class)->get($key, $default);
    }
}
