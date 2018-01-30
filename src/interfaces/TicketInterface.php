<?php
/**
 * TicketInterface
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexaua\yiisupport\interfaces;

/**
 * Interface TicketInterface
 */
interface TicketInterface
{
    const EVENT_CREATE = 'create';

    /**
     * @param bool $isResolved
     *
     * @return $this
     */
    public function setResolved($isResolved = true);

    /**
     * @return bool
     */
    public function isResolved();
}
