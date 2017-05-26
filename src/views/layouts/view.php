<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketPriority */


echo Html::tag('h1', Html::encode($this->title))
    . Html::tag('p');

if (Yii::$app->user->can($this->context->module->adminRole)) :
    echo Html::a(
        Yii::t('app', 'Update'),
        ['update', 'id' => $model->id],
        ['class' => 'btn btn-primary']
    );
endif;

if (Yii::$app->user->can($this->context->module->adminRole)) :
    Html::a(
        Yii::t('app', 'Delete'),
        ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method'  => 'post',
            ],
        ]
    );
endif;

echo Html::endTag('p');
