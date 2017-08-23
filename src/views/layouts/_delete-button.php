<?php

use hexa\yiisupport\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\ActiveRecord */


echo Html::a(
    Yii::t('support', 'Delete'),
    ['delete', 'id' => $model->id],
    [
        'class' => 'btn btn-danger',
        'data'  => [
            'confirm' => Yii::t('support', 'Are you sure you want to delete this item?'),
            'method'  => 'post',
        ],
    ]
);

