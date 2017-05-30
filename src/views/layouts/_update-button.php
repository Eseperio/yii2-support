<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketPriority */

use hexa\yiisupport\helpers\Html;

echo Html::a(
    Html::translate('Update'),
    ['update', 'id' => $model->id],
    ['class' => 'btn btn-primary']
);
