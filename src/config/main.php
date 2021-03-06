<?php

return [
    'id'                  => 'support',
    'controllerNamespace' => 'hexaua\yiisupport\controllers',
    'components'          => [
        'i18n' => [
            'class'        => '\yii\i18n\I18N',
            'translations' => [
                'support*' => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'basePath'       => __DIR__ . '/messages',
                    'sourceLanguage' => 'en-US'
                ],
            ],
        ],
    ],
    'params'              => [
        'secret' => 'comment',
    ],
    'adminRole'           => 'admin',
    'userRole'            => 'user',
    'authorNameTemplate'  => "{name} {email}",
];
