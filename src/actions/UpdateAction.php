<?php
/**
 * UpdateAction
 * @version     1.0
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\actions;

use hexa\yiisupport\db\ActiveRecord;

/**
 * Class UpdateAction
 */
class UpdateAction extends BaseAction
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function run($id)
    {
        /** @var ActiveRecord $model */
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('update', [
            'model' => $model,
        ]);
    }
}
