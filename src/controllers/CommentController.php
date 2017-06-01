<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\actions\DeleteAction;
use hexa\yiisupport\actions\IndexAction;
use hexa\yiisupport\actions\UpdateAction;
use hexa\yiisupport\actions\ViewAction;
use hexa\yiisupport\models\Comment;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

/**
 * Class CommentController
 */
class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        $className = Comment::className();

        return [
            'index'  => [
                'class'      => IndexAction::className(),
                'modelClass' => $className
            ],
            'view'   => [
                'class'      => ViewAction::className(),
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
                'only'  => ['index', 'view', 'delete', 'update'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['view'],
                        'roles'   => [$this->module->adminRole],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['delete', 'update'],
                        'roles'   => [$this->module->adminRole],
                    ],
                ],
            ],
        ];
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param $entity string encrypt entity
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCreate($entity)
    {
        $hash = \Yii::$app->security->decryptByKey(utf8_decode($entity), $this->config->get('params.secret'));
        $hash = Json::decode($hash);

        $ticket = $this->isAuthor(ArrayHelper::getValue($hash, 'ticket_id'));
        $model  = new Comment();
        $model->setAttributes($hash);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $ticket->setResolved(false)->touch('updated_at')->save(false);

            return $this->asJson([
                'status' => 'success'
            ]);
        }

        return $this->asJson([
            'status' => 'error',
            'errors' => ActiveForm::validate($model)
        ]);

    }
}
