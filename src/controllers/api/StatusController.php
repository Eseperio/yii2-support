<?php

namespace hexaua\yiisupport\controllers\api;

use hexaua\yiisupport\models\Status;

/**
 * Class StatusController
 *
 * @package api\modules\support\controllers
 */
class StatusController extends Controller
{
    public $modelClass = Status::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create'], $actions['update'], $actions['delete']);

        return $actions;
    }
}
