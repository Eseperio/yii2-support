<?php

return [
    'id'                  => 'support',
    'controllerNamespace' => 'hexa\yiisupport\controllers',
//    'components'          => [
//        'i18n'         => [
//            'class'        => '\yii\i18n\I18N',
//            'translations' => [
//                '*' => [
//                    'class'    => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@yiisupport/messages',
//                ],
//            ],
//        ],
//    ],
    'params'              => [
        'secret'    => 'comment',
    ],
    'adminRole'           => 'admin',
    'userRole'            => 'user',
    'authorNameTemplate'  => "{name} {email}",
];
