<?php
/**
 * ViewAction
 * @version     1.0
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\actions;

use yii\web\ForbiddenHttpException;

/**
 * Class ViewAction
 */
class ViewAction extends BaseAction
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function run($id)
    {
        return $this->controller->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @inheritdoc
     * @throws ForbiddenHttpException
     */
    public function beforeRun()
    {
        $id = \Yii::$app->request->get('id');

        if (\Yii::$app->user->can('updateTicket', ['ticket' => $this->findModel($id)])) {
            throw new ForbiddenHttpException(\Yii::t('app', 'You are not allowed'));
        }

        return true;
    }
}
