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
        $createTicket              = $auth->createPermission('createTicket');
        $createTicket->description = Yii::t('app', 'Create a ticket');
        $auth->add($createTicket);

        // add permission "commentTicket"
        $commentTicket              = $auth->createPermission('commentTicket');
        $commentTicket->description = Yii::t('app', 'Update a ticket');
        $auth->add($commentTicket);

        // get role "userRole" and add permission "createPost"
        $userRole = $auth->getRole($this->module->userRole);
        $auth->add($userRole);
        $auth->addChild($userRole, $createTicket);

        // get role "adminRole" and add permission "updatePost"
        // and all permission of role "userRole"
        $admin = $auth->getRole($this->module->adminRole);
        $auth->add($admin);
        $auth->addChild($admin, $commentTicket);
        $auth->addChild($admin, $userRole);

        $rule = new AuthorRule;
        $auth->add($rule);

        // add permission "commentOwnTicket" and link to permission rule.
        $commentOwnTicket              = $auth->createPermission('commentOwnTicket');
        $commentOwnTicket->description = Yii::t('app', 'Comment own tickets');
        $commentOwnTicket->ruleName    = $rule->name;
        $auth->add($commentOwnTicket);

        // "commentOwnTicket" will use from "commentTicket"
        $auth->addChild($commentOwnTicket, $commentTicket);

        // разрешаем "автору" обновлять его посты
        $auth->addChild($userRole, $commentOwnTicket);
    }
}
