<?php

return [
    'id'                  => 'support',
    'controllerNamespace' => 'hexa\yiisupport\controllers',
    'components'          => [

    ],
    'params'              => [
        'secret' => 'comment'
    ],
    'adminRole'           => 'admin',
    'userRole'            => 'user',
    'authorNameTemplate'  => "{name} {email}",
    'languageCategory'    => 'app',
];
