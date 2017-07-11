<?php

namespace hexa\yiisupport\controllers\api;

use hexa\yiisupport\models\Category;
use yii\rest\ActiveController;

/**
 * Class CategoryController
 *
 * @package api\modules\support\controllers
 */
class CategoryController extends ActiveController
{
    public $modelClass = Category::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create'], $actions['update'], $actions['delete']);

        return $actions;
    }
}
