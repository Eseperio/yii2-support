<?php
/**
 * CreateAction
 * @version     1.0
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\actions;

use yii\db\ActiveRecord;

/**
 * Class CreateAction
 */
class CreateAction extends BaseAction
{
    /**
     * @return mixed
     */
    public function run()
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('create', [
            'model' => $model,
        ]);
    }
}
