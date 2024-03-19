<?php

require_once './controllers/tweet/all.php';

?>

<?php if (!empty($tweets_array)) : ?>
    <div class="tweets-container">
        <?php foreach ($tweets_array as $tweet) : ?>
            <div class="tweet">
                <p><?= $tweet['username'] ?></p>
                <p><?= $tweet['tweet'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-tweets-container">No tweets yet</div>
<?php endif; ?>