<?php

use hexa\yiisupport\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\db\ActiveRecord */


echo Html::a(
    Yii::t('default', 'Delete'),
    ['delete', 'id' => $model->id],
    [
        'class' => 'btn btn-danger',
        'data'  => [
            'confirm' => Yii::t('default', 'Are you sure you want to delete this item?'),
            'method'  => 'post',
        ],
    ]
);

