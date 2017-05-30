<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\models\Ticket;
use yii\filters\AccessControl;

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
        $opened = Ticket::find()->resolved(false)->count();
        $closed = Ticket::find()->resolved(true)->count();

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
