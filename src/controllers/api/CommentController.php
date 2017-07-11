<?php

namespace hexa\yiisupport\controllers\api;

use hexa\yiisupport\models\Comment;
use hexa\yiisupport\models\Ticket;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class CommentController
 *
 * @package api\modules\support\controllers
 */
class CommentController extends ActiveController
{
    public $modelClass = Comment::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create']);

        $actions['index']['prepareDataProvider'] = [
            $this,
            'prepareDataProvider'
        ];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $modelClass = $this->modelClass;

        $ticketId = \Yii::$app->getRequest()->getQueryParam('ticketId');

        $query = $modelClass::find()->where(
            [
                'ticket_id' => $ticketId
            ]
        );

        return new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
    }

    public function actionCreate()
    {
        $ticket
            = $this->getTicket(\Yii::$app->request->getQueryParam('ticketId'));
        $model = new Comment();
        $model->load(\Yii::$app->request->post(), '');

        if (!$model->save() && !$model->hasErrors()) {
            throw new ServerErrorHttpException(
                'Failed to create the order for unknown reason.'
            );
        }

        $ticket->link('comments', $model);

        return $model;
    }

    public function getTicket($id)
    {
        $ticket = Ticket::findOne($id);

        if ($ticket === null) {
            throw new NotFoundHttpException("Object not found: $id");
        }

        return $ticket;
    }
}
