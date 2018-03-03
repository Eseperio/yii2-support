<?php

namespace hexaua\yiisupport\controllers;

use hexaua\yiisupport\actions\DeleteAction;
use hexaua\yiisupport\actions\ResolveAction;
use hexaua\yiisupport\actions\UpdateAction;
use hexaua\yiisupport\models\Category;
use hexaua\yiisupport\models\Priority;
use hexaua\yiisupport\models\search\TicketSearch;
use hexaua\yiisupport\models\Ticket;
use function Sodium\crypto_box_publickey_from_secretkey;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
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
        $className = Ticket::className();

        return [
            'delete'  => [
                'class'      => DeleteAction::className(),
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
                'class'      => AccessControl::className(),
                'ruleConfig' => [
                    'class'      => AccessRule::class,
                    'roleParams' => function ($rule) {

                        return [
                            'ticket' => $this->findTicket(\Yii::$app->request->get('id'))
                        ];
                    }
                ],
                'only'       => ['index', 'create', 'delete', 'update', 'view'],
                'rules'      => [
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
                        'actions' => ['view'],
                        'roles'   => ['isAuthor'],
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
        $query = Ticket::find()->joinWith(['category', 'status', 'priority']);

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
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findTicket($id);
        $hash  = $model->getHash($this->config->get('params.secret'), [
            'created_by' => \Yii::$app->user->id
        ]);

        return $this->render('view', [
            'hash'               => $hash,
            'model'              => $model,
            'comments'           => $model->comments,
            'authorNameTemplate' => $this->config->get('params.authorNameTemplate',
                "{name} {email}")
        ]);
    }

    public function actionUpdate($id)
    {
        $categories = Category::getList();
        $priorities = Priority::getList();

        $model = $this->isAuthor($id);

        if (\Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->load(\Yii::$app->request->post()) && $model->validate()
                && $model->download()->save(false)
            ) {
                return $this->redirect(['ticket/view', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
            'model'      => $model,
            'categories' => $categories,
            'priorities' => $priorities
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

            if ($model->load(\Yii::$app->request->post()) && $model->validate()
                && $model->download()->save(false)
            ) {
                return $this->redirect(['ticket/view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model'      => $model,
            'categories' => Category::getList(),
            'priorities' => Priority::getList()
        ]);
    }
}
