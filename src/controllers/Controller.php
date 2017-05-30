<?php
/**
 * Description....
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\controllers;

use hexa\yiisupport\interfaces\ConfigInterface;
use hexa\yiisupport\models\Ticket;
use yii\web\Controller as BaseController;
use yii\web\NotFoundHttpException;

/**
 * Class TicketController
 * TicketController implements the CRUD actions for Ticket model.
 */
class Controller extends BaseController
{
    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @inheritdoc
     *
     * @param ConfigInterface $config
     */
    public function __construct($id, $module, ConfigInterface $configService, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->config = $configService;
    }

    /**
     * @param integer $id
     *
     * @return Ticket
     * @throws NotFoundHttpException
     */
    protected function isAuthor($id)
    {
        $ticket = $this->findTicket($id);
        if (!\Yii::$app->user->can('isAuthor', ['ticket' => $ticket]) &&
            !\Yii::$app->user->can($this->config->get('adminRole'))
        ) {
            throw new NotFoundHttpException('Requested page does not exist.');
        }

        return $ticket;
    }

    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findTicket($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}