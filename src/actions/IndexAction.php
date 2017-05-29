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
use yii\helpers\ArrayHelper;

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
        $query     = $this->modelClass::find();
        $adminRole = ArrayHelper::getValue($this->controller->module, 'adminRole');

        if (!\Yii::$app->user->can($adminRole)) {
            $query->where([$this->getIdentityPrimaryKey() => \Yii::$app->user->id]);
        }

        return $query;
    }

    /**
     * Return name of primary key for identity AR model.
     * @return string
     */
    protected function getIdentityPrimaryKey()
    {
        $class = \Yii::$app->user->identityClass;
        list($primaryKey) = $class::primaryKey();

        return $primaryKey;
    }
}
