<?php

namespace modules\support\controllers;

use modules\support\models\Ticket;
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
}
