<?php
/**
 * TicketCommentQuery
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\db;

/**
 * Class TicketCommentQuery
 */
class TicketCommentQuery extends ActiveQuery
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
}
