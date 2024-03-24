<?php if (!empty($page_data['tweets'])) : ?>
    <div class="tweets-container">
        <?php foreach ($page_data['tweets'] as $tweet) : ?>
            <div class="tweet">
                <a href="/user/profile/<?= $tweet['user_id'] ?>" class="tweet__username"><?= $tweet['username'] ?></a>
                <div class="tweet__body"><?= $tweet['tweet'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-tweets-container">Aun no hay tweets.</div>
<?php endif; ?>