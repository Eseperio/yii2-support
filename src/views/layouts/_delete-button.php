<?php

use hexa\yiisupport\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\ActiveRecord */


echo Html::a(
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

