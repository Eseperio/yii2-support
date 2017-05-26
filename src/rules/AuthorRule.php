<?php
/**
 * AuthorRule
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\rules;

use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class AuthorRule extends Rule
{
    /**
     * Rule name.
     * @var string
     */
    public $name = 'isAuthor';

    /**
     * @param string|int $user   the user ID.
     * @param Item       $item   the role or permission that this rule is associated with
     * @param array      $params parameters passed to ManagerInterface::checkAccess().
     *
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['ticket']) ? $params['ticket']->created_by == $user : false;
    }
}
