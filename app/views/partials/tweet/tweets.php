<?php if (!empty($page_data['tweets'])) : ?>
    <div class="tweets-container">
        <?php foreach ($page_data['tweets'] as $tweet) : ?>
            <?php
            $profile_img = $tweet['author_image'] ?? DEFAULT_PROFILE_IMG_PATH;
            $tweet_time = tweetTime(strtotime($tweet['created_at']));
            ?>
            <div class="tweet">
                <div class="tweet__avatar">
                    <img src="<?= IMG_DIRECTORY . $profile_img ?>" alt="Avatar">
                </div>
                <div class="tweet-container">
                    <div class="tweet-container__header">
                        <a href="/user/profile/<?= $tweet['user_id'] ?>" class="tweet-container__name"><?= $tweet['author_name'] ?>
                        </a>
                        <a href="/user/profile/<?= $tweet['user_id'] ?>" class="tweet-container__username"><?= $tweet['author_username'] ?></a>
                        <span class="tweet-container__date"><?= $tweet_time ?></span>
                    </div>
                    <div class="tweet-container__body"><?= $tweet['tweet'] ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-tweets-container">Aun no hay tweets.</div>
<?php endif; ?>