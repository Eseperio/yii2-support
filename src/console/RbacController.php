<?php
/**
 * RbacController
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\console;

use hexa\yiisupport\rbac\AuthorRule;
use Yii;
use yii\console\Controller;

/**
 * Class RbacController
 */
class RbacController extends Controller
{
    /**
     * Create permissions.
     */
    public function actionPermissions()
    {
        $auth = Yii::$app->authManager;

        // add permission "createTicket"
        if (!($createTicket = $auth->getPermission('createTicket'))) {
            $createTicket              = $auth->createPermission('createTicket');
            $createTicket->description = Yii::t('app', 'Create a ticket');
            $auth->add($createTicket);
        }

        // add permission "commentTicket"
        if (!($commentTicket = $auth->getPermission('commentTicket'))) {
            $commentTicket              = $auth->createPermission('commentTicket');
            $commentTicket->description = Yii::t('app', 'Update a ticket');
            $auth->add($commentTicket);
        }

        // get role "userRole" and add permission "createTicket"
        if (!($userRole = $auth->getRole($this->module->userRole))) {
            $userRole = $auth->createRole($this->module->userRole);
            $auth->add($userRole);
        }

        if (!$auth->hasChild($userRole, $createTicket)) {
            $auth->addChild($userRole, $createTicket);
        }

        // get role "adminRole" and add permission "commentTicket"
        // and all permission of role "userRole"
        if (!($adminRole = $auth->getRole($this->module->adminRole))) {
            $adminRole = $auth->createRole($this->module->adminRole);
            $auth->add($adminRole);
        }

        if (!$auth->hasChild($adminRole, $commentTicket)) {
            $auth->addChild($adminRole, $commentTicket);
        }

        // Create author rule if not exist
        if (!($rule = $auth->getRule('isAuthor'))) {
            $rule = new AuthorRule;
            $auth->add($rule);
        }

        // add permission "commentOwnTicket" and link to permission rule.
        if (!($commentOwnTicket = $auth->getPermission('commentOwnTicket'))) {
            $commentOwnTicket              = $auth->createPermission('commentOwnTicket');
            $commentOwnTicket->description = Yii::t('app', 'Comment own tickets');
            $commentOwnTicket->ruleName    = $rule->name;
            $auth->add($commentOwnTicket);
        }

        // "commentOwnTicket" will use from "commentTicket"
        if (!$auth->hasChild($commentOwnTicket, $commentTicket)) {
            $auth->addChild($commentOwnTicket, $commentTicket);
        }

        if (!$auth->hasChild($userRole, $commentOwnTicket)) {
            // разрешаем "автору" обновлять его посты
            $auth->addChild($userRole, $commentOwnTicket);
        }
    }
}
