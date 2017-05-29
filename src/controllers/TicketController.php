<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\actions\CreateAction;
use hexa\yiisupport\actions\DeleteAction;
use hexa\yiisupport\actions\IndexAction;
use hexa\yiisupport\actions\UpdateAction;
use hexa\yiisupport\actions\ViewAction;
use hexa\yiisupport\models\Ticket;
use hexa\yiisupport\models\TicketComment;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class TicketController
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        $className = Ticket::className();
        $id        = \Yii::$app->request->get('id');

        return [
            'index'  => [
                'class'      => IndexAction::className(),
                'modelClass' => $className
            ],
            'view'   => [
                'class'      => ViewAction::className(),
                'modelClass' => $className,
                'params'     => [
                    'comments'           => TicketComment::find()->byTicketId($id)->all(),
                    'secret'             => $this->module->param('secret'),
                    'authorNameTemplate' => $this->module->param('authorNameTemplate', "{name} {email}")
                ]
            ],
            'create' => [
                'class'      => CreateAction::className(),
                'modelClass' => $className
            ],
            'delete' => [
                'class'      => DeleteAction::className(),
                'modelClass' => $className
            ],
            'update' => [
                'class'      => UpdateAction::className(),
                'modelClass' => $className
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['index', 'view', 'create', 'delete', 'update'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['delete', 'update'],
                        'roles'   => [$this->module->adminRole],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['index', 'view', 'create'],
                        'roles'   => [$this->module->userRole],
                    ]
                ],
            ],
        ];
    }
}
