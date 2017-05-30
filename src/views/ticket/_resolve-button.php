<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketPriority */

use hexa\yiisupport\helpers\Html;

echo Html::a(
    Html::translate('Resolve'),
    ['resolve', 'id' => $model->id],
    ['class' => 'btn btn-success']
);
