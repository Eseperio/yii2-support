<?php

/* @var $this \yii\web\View */
/* @var $comment \hexa\yiisupport\models\TicketComment */
/* @var $comments array */
/* @var $maxLevel null|integer comments max level */

if (!empty($comments)) : ?>
    <?php foreach ($comments as $comment) : ?>

        <div class="panel panel-default" id="comment-<?php echo $comment->id ?>">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Floy Christiansen
                    <span class="pull-right">
                        <?php echo $comment->created_at ?>
                    </span>
                </h3>
            </div>

            <div class="panel-body">
                <div class="content">
                    <?php echo nl2br($comment->content) ?>
                </div>
            </div>

        </div>
    <?php endforeach;
endif;
