<?php

use hexa\yiisupport\models\Comment;
use yii\web\View;

/**
 * @var $this               View
 * @var $comment            Comment
 * @var $comments           array
 * @var $authorNameTemplate string
 * @var $maxLevel           null|integer comments max level
 **/

if (!empty($comments)) : ?>
    <ul class="comment-section">
        <?php foreach ($comments as $comment) : ?>
            <li class="comment <?php echo $comment->isByAuthor() ? 'author' : 'admin'; ?>-comment"
                id="comment-<?php echo $comment->id; ?>">
                <div class="info">
                    <a href="#comment-<?php echo $comment->id; ?>">
                        <?php echo $comment->resolveAuthorSignature($authorNameTemplate); ?>
                    </a>
                    <span><?php echo Yii::$app->formatter->asRelativeTime($comment->created_at); ?></span>
                </div>

                <a class="avatar" href="#comment-<?php echo $comment->id; ?>">&nbsp;</a>

                <p>
                    <?php echo nl2br($comment->content); ?>
                </p>

            </li>
        <?php endforeach; ?>
    </ul>
<?php endif;
