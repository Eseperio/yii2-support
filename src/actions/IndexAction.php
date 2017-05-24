<?php
/**
 * IndexAction
 * @version     1.0
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\actions;


use yii\data\ActiveDataProvider;

/**
 * Class IndexAction
 */
class IndexAction extends BaseAction
{
    /**
     * @return mixed
     */
    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->modelClass::find(),
        ]);

        return $this->controller->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
