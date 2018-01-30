<?php
/**
 * Html
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexaua\yiisupport\helpers;

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
        if (\Yii::$app->controller->module->showTitle) {
            return static::tag($tag, static::encode($title));
        }

        return null;
    }
}
