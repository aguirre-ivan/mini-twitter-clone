<?php

require_once './controllers/tweet/all.php';

?>

<?php if (!empty($tweets_array)) : ?>
    <div class="tweets-container">
        <?php foreach ($tweets_array as $tweet) : ?>
            <div class="tweet">
                <a href="./views/user/profile.php?id=<?= $tweet['user_id'] ?>" class="tweet__username"><?= $tweet['username'] ?></a>
                <div class="tweet__body"><?= $tweet['tweet'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-tweets-container">No tweets yet</div>
<?php endif; ?>