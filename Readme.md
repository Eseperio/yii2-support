# Yii support module


### Installation
Edit your composer.json file, in **require** section add
```php
"hexa/yiisupport": "dev-master"

// Example
"require": {
    "hexa/yiisupport": "dev-master"
}
```
Following lines need to be added in **repositories** section
```php
{
    "type": "git",
    "url" : "git@git.hexa.com.ua:yii2/support.git"
}
    
// Example
"repositories"     : [
    {
        "type": "git",
        "url" : "git@git.hexa.com.ua:yii2/support.git"
    }
]
```
### Apply migrations
To apply module migrations from project root run the following command
```text
php yii migrate --migrationPath=hexa\yiisupport\migrations
```

### Create permissions
Your project must support rbac and have at least two roles. One for administrator and one for user.
```text
php yii support/permissions
```