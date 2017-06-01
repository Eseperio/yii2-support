<?php
/**
 * Button group view
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

use hexa\yiisupport\helpers\Html;
use hexa\yiisupport\interfaces\ConfigInterface;

$config    = Yii::$container->get(ConfigInterface::class);
$adminRole = $config->get('adminRole');
$isUpdate  = $config->get('buttons.update');
$isDelete  = $config->get('buttons.delete');
$isResolve = $config->get('buttons.resolve');

echo Html::beginTag('div', ['class' => 'btn-group margin-bottom-20']);
if (Yii::$app->user->can('updateTicket') && $isUpdate) :
    echo $this->render('_update-button', [
        'model' => $model
    ]);
endif;

if (Yii::$app->user->can('deleteTicket') && $isDelete) :
    echo $this->render('_delete-button', [
        'model' => $model
    ]);
endif;

if ((Yii::$app->user->can('isAuthor') || Yii::$app->user->can($adminRole)) && $isResolve) :
    echo $this->render('@yiisupport/views/layouts/_resolve-button', [
        'model' => $model
    ]);
endif;


echo Html::endTag('div');
