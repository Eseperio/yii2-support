<?php

namespace hexa\yiisupport\controllers\api;

use hexa\yiisupport\models\Priority;
use yii\rest\ActiveController;

/**
 * Class PriorityController
 *
 * @package api\modules\support\controllers
 */
class PriorityController extends ActiveController
{

    public $modelClass = Priority::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create'], $actions['update'], $actions['delete']);

        return $actions;
    }
}
