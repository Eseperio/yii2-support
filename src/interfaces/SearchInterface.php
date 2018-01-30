<?php
/**
 * SearchInterface
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexaua\yiisupport\interfaces;

use yii\data\DataProviderInterface;

/**
 * Interface SearchInterface
 */
interface SearchInterface
{
    /**
     * @param array $queryParams
     * @param array $providerParams
     *
     * @return DataProviderInterface
     */
    public function search(array $queryParams, array $providerParams = []);
}
