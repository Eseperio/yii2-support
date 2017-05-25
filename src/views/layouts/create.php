<?php

use yii\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model \hexa\yiisupport\models\TicketPriority
 */

echo Html::beginTag('div', $options); ?>

    <h1>
        <?php echo Html::encode($this->title); ?>
    </h1>

<?php echo $this->render('_form', [
    'model' => $model,
]);

echo Html::endTag('div');
