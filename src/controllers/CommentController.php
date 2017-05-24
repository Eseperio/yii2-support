<?php

namespace modules\support\controllers;

use hexa\yiisupport\actions\DeleteAction;
use hexa\yiisupport\actions\IndexAction;
use hexa\yiisupport\actions\UpdateAction;
use hexa\yiisupport\actions\ViewAction;
use modules\support\models\TicketComment;
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
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param $entity string encrypt entity
     *
     * @return mixed
     */
    public function actionCreate($entity)
    {
        $hash = \Yii::$app->security->decryptByKey(utf8_decode($entity), 'comment');

        if ($hash !== false) {

            $model = new TicketComment();
            $model->setAttributes(Json::decode($hash));

            if ($model->load(\Yii::$app->getRequest()->post()) && $model->save()) {
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
            'message' => 'Oops, something went wrong. Please try again later.'
        ]);
    }
}
