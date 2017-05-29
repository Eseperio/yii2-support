<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\actions\DeleteAction;
use hexa\yiisupport\actions\IndexAction;
use hexa\yiisupport\actions\UpdateAction;
use hexa\yiisupport\actions\ViewAction;
use hexa\yiisupport\models\TicketComment;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
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
        $className = TicketComment::className();

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
                'only'  => ['index', 'view', 'create', 'delete', 'update'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['index', 'view', 'create'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['delete', 'update'],
                        'roles'   => [$this->module->adminRole],
                    ]
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
     */
    public function actionCreate($entity)
    {
        $hash = \Yii::$app->security->decryptByKey(utf8_decode($entity), $this->module->param('secret'));

        if ($hash !== false) {

            $model = new TicketComment();
            $model->setAttributes(Json::decode($hash));

            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                return $this->asJson([
                    'status' => 'success'
                ]);
            }

            return $this->asJson([
                'status' => 'error',
                'errors' => ActiveForm::validate($model)
            ]);
        }

        return $this->asJson([
            'status'  => 'error',
            'message' => \Yii::t('app', 'Oops, something went wrong. Please try again later.')
        ]);
    }
}
