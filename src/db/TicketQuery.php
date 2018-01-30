<?php
/**
 * TicketQuery
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexaua\yiisupport\db;

/**
 * Class TicketQuery
 */
class TicketQuery extends ActiveQuery
{

    /**
     * @param integer $id
     *
     * @return $this
     */
    public function byTicketId($id)
    {
        return $this->byAttribute('ticket_id', $id);
    }

    /**
     * @param integer $id
     *
     * @return $this
     */
    public function byUserId($id)
    {
        return $this->byAttribute('created_by', $id);
    }

    /**
     * @param bool $isResolved
     *
     * @return $this
     *
     */
    public function resolved($isResolved = true)
    {
        return $this->byAttribute('S.resolve', (int)$isResolved);
    }
}
