<?php

namespace hexa\yiisupport\controllers\api;

use hexa\yiisupport\models\Ticket;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UnprocessableEntityHttpException;

/**
 * Class TicketController
 *
 * @package api\modules\support\controllers
 */
class TicketController extends ActiveController
{
    public $modelClass = Ticket::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create'], $actions['update'], $actions['delete'], $actions['view']);

        $actions['index']['prepareDataProvider'] = [
            $this,
            'prepareDataProvider'
        ];

        return $actions;
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     *
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $modelClass = $this->modelClass;

        $userId = \Yii::$app->user->id;

        return new ActiveDataProvider([
            'query' => $modelClass::find()->where([
                'created_by' => $userId
            ]),
        ]);
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new Ticket();

        if ($model->load(\Yii::$app->request->post(), '')) {
            $model->setAttribute(
                'client_id',
                \Yii::$app->getUser()->getIdentity()->getId()
            );
            if (!$model->save() && !$model->hasErrors()) {
                throw new UnprocessableEntityHttpException(
                    'Failed to create the ticket for unknown reason.'
                );
            }

            return $model;
        }

        throw new BadRequestHttpException(
            'Unknown errors while handle request'
        );
    }

    protected function findModel($id)
    {
        $model = Ticket::findOne($id);

        if (isset($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
}
