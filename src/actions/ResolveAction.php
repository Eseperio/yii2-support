<?php
/**
 * ResolveAction
 * @version     1.0
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexaua\yiisupport\actions;

use hexaua\yiisupport\models\Ticket;
use yii\web\ForbiddenHttpException;

/**
 * Class ResolveAction
 */
class ResolveAction extends BaseAction
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function run($id)
    {
        /** @var Ticket $model */
        $model = $this->findModel($id);
        $model->setResolved(true)->save(false);

        return $this->redirect([$this->controller->getUniqueId() . '/view', 'id' => $model->id]);
    }
}
