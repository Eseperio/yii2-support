<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\actions\CreateAction;
use hexa\yiisupport\actions\DeleteAction;
use hexa\yiisupport\actions\IndexAction;
use hexa\yiisupport\actions\ResolveAction;
use hexa\yiisupport\actions\UpdateAction;
use hexa\yiisupport\models\Ticket;
use hexa\yiisupport\models\TicketCategory;
use hexa\yiisupport\models\TicketComment;
use hexa\yiisupport\models\TicketPriority;
use yii\filters\AccessControl;
use yii\web\HttpException;

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

        return [
            'index'   => [
                'class'      => IndexAction::className(),
                'modelClass' => $className
            ],
            'create'  => [
                'class'      => CreateAction::className(),
                'modelClass' => $className,
                'params'     => [
                    'categories' => TicketCategory::list(),
                    'priorities' => TicketPriority::list()
                ]
            ],
            'delete'  => [
                'class'      => DeleteAction::className(),
                'modelClass' => $className
            ],
            'update'  => [
                'class'      => UpdateAction::className(),
                'modelClass' => $className
            ],
            'resolve' => [
                'class'      => ResolveAction::className(),
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
                'only'  => ['index', 'create', 'delete', 'update'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['delete'],
                        'roles'   => ['deleteTicket'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['update'],
                        'roles'   => ['updateTicket'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['create'],
                        'roles'   => ['createTicket'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['index'],
                        'roles'   => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * @param integer $id
     *
     * @return string
     * @throws HttpException
     */
    public function actionView($id)
    {
        $model = $this->isAuthor($id);
        $hash  = $model->getHash($this->config->get('params.secret'), [
            'created_by' => \Yii::$app->user->id
        ]);

        return $this->render('view', [
            'hash'               => $hash,
            'model'              => $model,
            'comments'           => $model->comments,
            'authorNameTemplate' => $this->config->get('params.authorNameTemplate', "{name} {email}")
        ]);
    }
}
