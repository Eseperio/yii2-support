<?php
/**
 * TicketSearch
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexaua\yiisupport\models\search;

use hexaua\yiisupport\interfaces\SearchInterface;
use hexaua\yiisupport\models\Ticket;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * Class TicketSearch
 */
class TicketSearch extends Ticket implements SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        ArrayHelper::merge(parent::rules(), [
            ['!user_id', 'integer']
        ]);
    }

    /**
     * @param array $queryParams
     * @param array $providerParams
     *
     * @return mixed
     */
    public function search(array $queryParams, array $providerParams = [])
    {
        $query          = static::find();
        $providerParams = ArrayHelper::merge([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ], $providerParams);

        $dataProvider     = new ActiveDataProvider($providerParams);
        $sort             = $dataProvider->getSort();
        $sort->attributes = ArrayHelper::merge($sort->attributes, [
            'status_id'   => [
                'asc'  => ['S.name' => SORT_ASC],
                'desc' => ['S.name' => SORT_DESC],
            ],
            'priority_id' => [
                'asc'  => ['P.name' => SORT_ASC],
                'desc' => ['P.name' => SORT_DESC],
            ],
            'category_id' => [
                'asc'  => ['C.name' => SORT_ASC],
                'desc' => ['C.name' => SORT_DESC],
            ],
        ]);
        $dataProvider->setSort($sort);

        if (!$this->load($queryParams) || !$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
