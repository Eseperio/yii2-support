<?php

/* @var $this yii\web\View */
/* @var $model \hexaua\yiisupport\models\Priority */

use hexaua\yiisupport\helpers\Html;

echo Html::a(
    Yii::t('support', 'Resolve'),
    ['resolve', 'id' => $model->id],
    ['class' => 'btn btn-success']
);
