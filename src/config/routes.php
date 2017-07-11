<?php
return [
    [
        'class' => 'yii\rest\UrlRule',
        'prefix' => 'support',
        'controller' => [
            'tickets' => 'support/api/ticket'
        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'prefix' => 'support',
        'controller' => [
            'priorities' => 'support/api/priority'
        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'prefix' => 'support',
        'controller' => [
            'categories' => 'support/api/category'
        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'prefix' => 'support',
        'controller' => [
            'statuses' => 'support/api/status'
        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',

        'controller' => [
            'comments' => 'support/api/comment'
        ],
        'prefix' => 'support/tickets/<ticketId:\d+>'
    ],
];
