<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \modules\support\models\TicketStatus */

$this->title = 'Create Status';
$this->params['breadcrumbs'][] = ['label' => 'Statuses', 'url' => ['index']];
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
