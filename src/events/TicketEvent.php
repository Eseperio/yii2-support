<?php
/**
 * TicketEvent
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\events;

use hexa\yiisupport\models\Ticket;
use yii\base\Event;

/**
 * Class TicketEvent
 */
class TicketEvent extends Event
{
    /**
     * @var Ticket
     */
    public $ticket;

    /**
     * @var bool
     */
    public $isValid;
}
