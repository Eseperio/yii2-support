<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \modules\support\models\TicketPriority */

$this->title                   = 'Update Priority: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Priorities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ticket-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render(
        '_form', [
        'model' => $model,
        ]
    ) ?>

</div>
