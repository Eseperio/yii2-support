<?php
/**
 * RbacController
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexaua\yiisupport\console;

use hexaua\yiisupport\rbac\AuthorRule;
use Yii;
use yii\console\Controller;
use yii\rbac\Item;

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
        // Create permissions: createTicket, deleteTicket, updateTicket, resolveTicket, addComment.
        $createTicket = $this->createPermission('createTicket', null, 'Create ticket');
        $deleteTicket = $this->createPermission('deleteTicket', null, 'Delete ticket');
        $updateTicket = $this->createPermission('updateTicket', null, 'Update ticket');

        // Create roles
        $userRole  = $this->createRole($this->module->userRole);
        $adminRole = $this->createRole($this->module->adminRole);

        $this
            ->addChild($userRole, $createTicket)   // Add createTicket to userRole
            ->addChild($adminRole, $createTicket)  // Add createTicket to adminRole
            ->addChild($adminRole, $deleteTicket)  // Add deleteTicket to adminRole
            ->addChild($adminRole, $updateTicket); // Add updateTicket to adminRole

        $rule = $this->createAuthorRule('isAuthor');

        // add permission "isAuthor" and link to permission rule.
        $isAuthor = $this->createPermission('isAuthor', $rule->name, Yii::t('app', 'Resolve, comment own ticket'));

        $this
            ->addChild($userRole, $isAuthor)
            ->addChild($adminRole, $userRole);
    }

    /**
     * Create permission if not exists.
     *
     * @param string $name        Permission name
     * @param string $ruleName    Rule name
     * @param string $description Permission description
     *
     * @return \yii\rbac\Permission
     */
    protected function createPermission($name, $ruleName = null, $description = null)
    {
        $auth = Yii::$app->authManager;

        // Check if permission already exists
        if (!($permission = $auth->getPermission($name))) {
            $permission              = $auth->createPermission($name);
            $permission->ruleName    = $ruleName;
            $permission->description = Yii::t('app', $description);
            $auth->add($permission);
        }

        return $permission;
    }

    /**
     * Create role if not exists.
     *
     * @param string $name Role name
     *
     * @return \yii\rbac\Role
     */
    protected function createRole($name)
    {
        $auth = Yii::$app->authManager;

        if (!($role = $auth->getRole($name))) {
            $role = $auth->createRole($name);
            $auth->add($role);
        }

        return $role;
    }

    /**
     * @param string $name
     *
     * @return AuthorRule|\yii\rbac\Rule
     */
    public function createAuthorRule($name)
    {
        $auth = Yii::$app->authManager;

        // Create author rule if not exist
        if (!($rule = $auth->getRule($name))) {
            $rule = new AuthorRule;
            $auth->add($rule);
        }

        return $rule;
    }

    /**
     * @param Item $parent
     * @param Item $child
     *
     * @return $this
     */
    protected function addChild($parent, $child)
    {
        $auth = Yii::$app->authManager;

        if (!$auth->hasChild($parent, $child)) {
            $auth->addChild($parent, $child);
        }

        return $this;
    }
}
