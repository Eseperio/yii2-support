<?php
/**
 * TicketQuery
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\db;

use yii\db\Expression;

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
     * @return $this
     */
    public function opened()
    {
        return $this->andWhere((['completed_at' => null]));
    }

    /**
     * @return $this
     */
    public function closed()
    {
        return $this->andWhere([
            'IS',
            'completed_at',
            new Expression('NOT NULL'),
        ]);
    }
}
