# Yii support module


### Installation
Edit your composer.json file, in **require** section add
```php
"hexaua/yii2-support": "dev-master"

// Example
"require": {
    "hexaua/yii2-support": "dev-master"
}
```
### Apply migrations
To apply module migrations from project root run the following command
```text
php yii migrate --migrationPath=hexaua\yiisupport\migrations
```

### Create permissions
Your project must support rbac and have at least two roles. One for administrator and one for user.
```text
php yii support/permissions
```

### Include module

Configuring module
```php
'modules' => [
    'support' => [
        'class'    => 'hexaua\yiisupport\Module',
        'userRole' => 'partner', // Default to user
        'adminRole => 'admin'    // Default to admin
    ]
]
```
