<?php
/**
 * TicketStatusQuery
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\db;

use hexa\yiisupport\models\Status;

/**
 * Class TicketStatusQuery
 */
class TicketStatusQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function resolved()
    {
        return $this->byAttribute('resolve', true);
    }

    /**
     * @return $this
     */
    public function default()
    {
        return $this->byAttribute('default', true);
    }
}
