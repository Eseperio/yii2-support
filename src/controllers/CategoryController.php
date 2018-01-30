<?php

namespace hexaua\yiisupport\controllers;

use hexaua\yiisupport\actions\CreateAction;
use hexaua\yiisupport\actions\DeleteAction;
use hexaua\yiisupport\actions\IndexAction;
use hexaua\yiisupport\actions\UpdateAction;
use hexaua\yiisupport\actions\ViewAction;
use hexaua\yiisupport\models\Category;
use yii\filters\AccessControl;

/**
 * Class CategoryController
 */
class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        $className = Category::className();

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
                        'allow' => true,
                        'roles' => [$this->module->adminRole],
                    ]
                ],
            ],
        ];
    }
}
