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
                    <a href="#">
                        <?php echo $comment->resolveAuthorSignature($authorNameTemplate); ?>
                    </a>
                    <span><?php echo Yii::$app->formatter->asDatetime($comment->created_at); ?></span>
                </div>

                <a class="avatar" href="#comment-<?php echo $comment->id; ?>">
                    <img width="35" alt="Profile Avatar"
                         title="<?php echo $comment->resolveAuthorSignature($authorNameTemplate); ?>"/>
                </a>

                <p><?php echo nl2br($comment->content); ?></p>

            </li>
        <?php endforeach; ?>
    </ul>
<?php endif;
