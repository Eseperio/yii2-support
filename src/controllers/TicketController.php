<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\actions\DeleteAction;
use hexa\yiisupport\actions\ResolveAction;
use hexa\yiisupport\actions\UpdateAction;
use hexa\yiisupport\models\Category;
use hexa\yiisupport\models\Priority;
use hexa\yiisupport\models\search\TicketSearch;
use hexa\yiisupport\models\Ticket;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\web\UploadedFile;

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
     * @return string
     */
    public function actionIndex()
    {
        $query = Ticket::find();
        if (!\Yii::$app->user->can($this->config->get('adminRole'))) {
            $query->byUserId(\Yii::$app->user->id);
        }

        $filterModel  = new TicketSearch();
        $dataProvider = $filterModel->search(\Yii::$app->request->queryParams, [
            'query' => $query
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'isUpdate'     => $this->config->get('buttons.update'),
            'isDelete'     => $this->config->get('buttons.update'),
        ]);
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

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ticket();

        if (\Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->load(\Yii::$app->request->post()) &&
                $model->validate() &&
                $model->download()->save(false)
            ) {
                return $this->redirect(['ticket/view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model'      => $model,
            'categories' => Category::list(),
            'priorities' => Priority::list()
        ]);
    }
}
