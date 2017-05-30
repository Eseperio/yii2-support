<?php

use hexa\yiisupport\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\db\ActiveRecord */


echo Html::a(
    Html::translate('Delete'),
    ['delete', 'id' => $model->id],
    [
        'class' => 'btn btn-danger',
        'data'  => [
            'confirm' => Html::translate('Are you sure you want to delete this item?'),
            'method'  => 'post',
        ],
    ]
);

