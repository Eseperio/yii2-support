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

use hexa\yiisupport\models\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class IndexAction
 */
class IndexAction extends BaseAction
{
    /**
     * Closure for modify query.
     * @var \Closure
     */
    public $query;

    /**
     * Params will be passed to dataProvider.
     * @var array
     * @see ActiveDataProvider
     */
    public $providerParams = [
        'sort' => [
            'defaultOrder' => [
                'id' => SORT_DESC
            ]
        ]
    ];

    /**
     * @return mixed
     */
    public function run()
    {
        $providerParams = ArrayHelper::merge([
            'query' => $this->getQuery(),
        ], $this->providerParams);

        $dataProvider = new ActiveDataProvider($providerParams);

        return $this->controller->render('index', ArrayHelper::merge([
            'dataProvider' => $dataProvider,
        ], (array)$this->params));
    }

    /**
     * @return ActiveQuery
     */
    protected function getQuery()
    {
        /** @var ActiveRecord $class */
        $class = $this->modelClass;
        $query = $class::find();

        if (!\Yii::$app->user->can($this->config->get('adminRole'))) {
            $query->where(['created_by' => \Yii::$app->user->id]);
        }

        if (is_callable($this->query)) {
            call_user_func($this->query, $query);
        }

        return $query;
    }
}
