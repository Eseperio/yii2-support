<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \modules\support\models\TicketPriority */

$this->title = 'Create Priority';
$this->params['breadcrumbs'][] = ['label' => 'Priorities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render(
        '_form', [
        'model' => $model,
        ]
    ) ?>

</div>
