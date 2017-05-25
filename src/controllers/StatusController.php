<?php

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\actions\CreateAction;
use hexa\yiisupport\actions\DeleteAction;
use hexa\yiisupport\actions\IndexAction;
use hexa\yiisupport\actions\UpdateAction;
use hexa\yiisupport\actions\ViewAction;
use hexa\yiisupport\models\TicketStatus;
use yii\web\Controller;

/**
 * Class StatusController
 */
class StatusController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        $className = TicketStatus::className();

        return [
            'index'  => [
                'class'      => IndexAction::className(),
                'modelClass' => $className
            ],
            'view'   => [
                'class'      => ViewAction::className(),
                'modelClass' => $className
            ],
            'create' => [
                'class'      => CreateAction::className(),
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
}
