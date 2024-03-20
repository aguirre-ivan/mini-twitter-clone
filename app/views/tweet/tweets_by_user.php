<?php

require_once '../../controllers/tweet/all_by_user.php';

?>

<?php if (!empty($tweets_array)) : ?>
    <div class="tweets-container">
        <?php foreach ($tweets_array as $tweet) : ?>
            <div class="tweet">
                <div class="tweet__username"><?= $tweet['username'] ?></div>
                <div class="tweet__body"><?= $tweet['tweet'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-tweets-container">No tweets yet</div>
<?php endif; ?>