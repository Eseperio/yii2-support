<?php

use yii\widgets\Pjax;

/**
 * @var $this                \yii\web\View
 * @var $comments            array
 * @var $model               \modules\support\models\TicketComment
 * @var $maxLevel            null|integer comments max level
 * @var $hash                string
 * @var $containerId         string
 * @var $formId              string comment form id
 * @var $showDeletedComments boolean show deleted comments
 **/

$showDeletedComments = true;

Pjax::begin([
    'enablePushState' => false,
    'timeout'         => 20000,
    'id'              => $containerId
]); ?>
    <div class="comments">
        <div class="title-block clearfix clear">

            <h3 class="h3-body-title">
                <?php echo Yii::t('app', 'Comments') . '(' . $model->getCommentsCount() . ')'; ?>
            </h3>

            <div class="title-separator"></div>
        </div>
        <?php echo $this->render('_list', ['comments' => $comments, 'maxLevel' => 3]); ?>
        <?php echo $this->render('_form', [
            'model'  => $model,
            'hash'   => $hash,
            'formId' => $formId
        ]); ?>

    </div>
<?php Pjax::end();