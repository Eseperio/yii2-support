<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var $this   \yii\web\View
 * @var $model  \hexa\yiisupport\models\TicketComment
 * @var $hash   string
 * @var $formId string comment form id
 */

?>

<div class="comment-form-container">
    <?php $form = ActiveForm::begin(
        [
            'options'          => [
                'id'    => $formId,
                'class' => 'comment-box'
            ],
            'action'           => Url::to(
                [
                    'create',
                    'entity' => $hash
                ]
            ),
            'validateOnChange' => false,
            'validateOnBlur'   => false
        ]
    ); ?>

    <?php echo $form->field($model, 'content', ['template' => '{input}{error}'])->textarea([
        'placeholder' => Yii::t('app', 'Add a comment...'),
        'rows'        => 4,
        'data'        => ['comment' => 'content']
    ]); ?>

    <div class="comment-box-partial">
        <div class="button-container show">
            <?php echo Html::submitButton(
                Yii::t('app', 'Comment'),
                ['class' => 'btn btn-primary comment-submit']
            ); ?>
        </div>
    </div>
    <?php $form->end(); ?>
</div>
