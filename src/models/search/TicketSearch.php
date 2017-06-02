<?php
/**
 * TicketSearch
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\models\search;

use hexa\yiisupport\interfaces\SearchInterface;
use hexa\yiisupport\models\Ticket;
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

        $dataProvider = new ActiveDataProvider($providerParams);

        if (!$this->load($queryParams) || !$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}