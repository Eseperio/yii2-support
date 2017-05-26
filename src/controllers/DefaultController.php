<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\models\Ticket;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $all    = Ticket::find()->count();
        $opened = Ticket::find()->opened()->count();
        $closed = Ticket::find()->closed()->count();

        return $this->render('index', [
            'all'    => $all,
            'opened' => $opened,
            'closed' => $closed,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [$this->module->adminRole],
                    ]
                ],
            ],
        ];
    }
}
