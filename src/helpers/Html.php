<?php
/**
 * Html
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\helpers;

use hexa\yiisupport\interfaces\ConfigInterface;

/**
 * Class Html
 */
class Html extends \yii\helpers\Html
{
    /**
     * @param string $title
     * @param string $tag
     *
     * @return string
     */
    public static function title($title, $tag)
    {
        if (static::config('showTitle')) {

            $title = static::encode($title);
            $title = static::translate($title);

            return static::tag($tag, $title);
        }

        return null;
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public static function translate($text)
    {
        return \Yii::t(static::config('languageCategory', 'app'), $text);
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @see ConfigInterface::get()
     *
     * @return ConfigInterface
     */
    public static function config($key, $default = null)
    {
        return \Yii::$container->get(ConfigInterface::class)->get($key, $default);
    }
}
