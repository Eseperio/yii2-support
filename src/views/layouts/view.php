<?php

/* @var $this yii\web\View */

use hexa\yiisupport\helpers\Html;
use hexa\yiisupport\interfaces\ConfigInterface;

$config    = Yii::$container->get(ConfigInterface::class);
$adminRole = $config->get('adminRole');

if (Yii::$app->user->can($adminRole)) :
    echo Html::title($this->title, 'h1');

    echo Html::tag('p');

    echo $this->render('_update-button', [
        'model' => $model
    ]);
    echo $this->render('_delete-button', [
        'model' => $model
    ]);

    echo Html::endTag('p');

endif;
