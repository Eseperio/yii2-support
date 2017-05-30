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
use yii\db\ActiveQuery;

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
            'query' => $this->getQuery(),
            'sort'  => [
                'defaultOrder' => [
                    'created_at'   => SORT_DESC,
                    'completed_at' => SORT_DESC
                ]
            ]
        ]);

        return $this->controller->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return ActiveQuery
     */
    protected function getQuery()
    {
        $query = $this->modelClass::find();

        if (!\Yii::$app->user->can($this->config->get('adminRole'))) {
            $query->where(['created_by' => \Yii::$app->user->id]);
        }

        return $query;
    }
}
