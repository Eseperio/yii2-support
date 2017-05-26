<?php
/**
 * BaseAction
 * @version     1.0
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\actions;

use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Class BaseAction
 */
abstract class BaseAction extends Action
{
    /**
     * @var string
     */
    public $modelClass;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!$this->modelClass) {
            throw new InvalidConfigException("Property modelClass must be set");
        }
    }

    /**
     * @param string|array $url
     * @param int          $status
     * @param bool         $checkAjax
     *
     * @return \yii\web\Response
     */
    protected function redirect($url, $status = 302, $checkAjax = true)
    {
        return \Yii::$app->response->redirect($url, $status, $checkAjax);
    }

    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return ActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->modelClass::find()->byId($id)->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
