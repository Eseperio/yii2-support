<?php
/**
 * Config
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\helpers;

use hexa\yiisupport\interfaces\ConfigInterface;
use hexa\yiisupport\Module;
use yii\base\Object;
use yii\di\ServiceLocator;
use yii\helpers\ArrayHelper;

/**
 * Class Config
 */
class Config extends Object implements ConfigInterface
{
    /**
     * @var Module
     */
    protected $reference;

    /**
     * Config constructor.
     *
     * @param ServiceLocator $reference
     * @param array          $config
     */
    public function __construct(ServiceLocator $reference, $config = [])
    {
        parent::__construct($config);

        $this->reference = $reference;
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return ArrayHelper::getValue($this->reference, $key, $default);
    }

    /**
     * Check if Module property exist.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return property_exists($this->reference, $key);
    }
}
