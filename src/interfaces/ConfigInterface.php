<?php
/**
 * ConfigInterface
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexaua\yiisupport\interfaces;

/**
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /**
     * Returns value of Module property.
     *
     * @param string $key     Module property name
     * @param mixed  $default Default value if property not exist
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Check if Module property exist.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key);
}
