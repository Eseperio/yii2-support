<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\actions\CreateAction;
use hexa\yiisupport\actions\DeleteAction;
use hexa\yiisupport\actions\IndexAction;
use hexa\yiisupport\actions\ResolveAction;
use hexa\yiisupport\actions\UpdateAction;
use hexa\yiisupport\models\Category;
use hexa\yiisupport\models\Priority;
use hexa\yiisupport\models\Ticket;
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
        $className  = Ticket::className();
        $categories = Category::list();
        $priorities = Priority::list();

        return [
            'index'   => [
                'class'          => IndexAction::className(),
                'modelClass'     => $className,
                'query'          => function ($query) {
                    $query->joinWith(['status S', 'priority P', 'category C']);
                },
                'params'         => [
                    'isUpdate' => $this->config->get('buttons.update'),
                    'isDelete' => $this->config->get('buttons.update'),
                ],
                'providerParams' => [
                    'sort' => [
                        'attributes' => [
                            'status_id'   => [
                                'asc'  => ['S.name' => SORT_ASC],
                                'desc' => ['S.name' => SORT_DESC],
                            ],
                            'priority_id' => [
                                'asc'  => ['P.name' => SORT_ASC],
                                'desc' => ['P.name' => SORT_DESC],
                            ],
                            'category_id' => [
                                'asc'  => ['C.name' => SORT_ASC],
                                'desc' => ['C.name' => SORT_DESC],
                            ],
                            'id',
                            'subject',
                            'completed_at',
                            'created_at',
                        ]
                    ]
                ]
            ],
            'create'  => [
                'class'      => CreateAction::className(),
                'modelClass' => $className,
                'params'     => [
                    'categories' => $categories,
                    'priorities' => $priorities
                ]
            ],
            'delete'  => [
                'class'      => DeleteAction::className(),
                'modelClass' => $className
            ],
            'update'  => [
                'class'      => UpdateAction::className(),
                'modelClass' => $className,
                'params'     => [
                    'categories' => $categories,
                    'priorities' => $priorities
                ]
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
