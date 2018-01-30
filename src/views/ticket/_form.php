<?php

use hexaua\yiisupport\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this       yii\web\View
 * @var $model      \hexaua\yiisupport\models\Ticket
 * @var $form       yii\widgets\ActiveForm
 * @var $categories array
 * @var $priorities array
 **/
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin();

    echo $form->errorSummary($model);

    echo $form->field($model, 'subject')->textInput(['maxlength' => true]);
    echo $form->field($model, 'content')->textarea(['rows' => 6]);
    echo $form->field($model, 'priority_id')->dropdownList($priorities, [
        'prompt' => Yii::t('support', 'Select Priority')
    ]);
    echo $form->field($model, 'category_id')->dropdownList($categories, [
        'prompt' => Yii::t('support', 'Select Category')
    ]);

    if ($model->file) {
        echo Html::a($model->basename(), Yii::$app->controller->module->getUrl($model->file), ['target' => '_blank']);
    }

    echo $form->field($model, 'file')->fileInput(); ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            Yii::t('support', 'Save'), [
            'class' => 'btn btn-primary',
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
