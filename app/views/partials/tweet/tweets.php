<?php if (!empty($page_data['tweets'])) : ?>
    <div class="tweets-container">
        <?php foreach ($page_data['tweets'] as $tweet) : ?>
            <div class="tweet">
                <div class="tweet__header">
                    <a href="/user/profile/<?= $tweet['user_id'] ?>" class="tweet__name">
                        <?= $tweet['author_name'] ?>
                    </a>
                    <a href="/user/profile/<?= $tweet['user_id'] ?>" class="tweet__username">
                        <?= $tweet['author_username'] ?>
                    </a>
                </div>
                <div class="tweet__body"><?= $tweet['tweet'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-tweets-container">Aun no hay tweets.</div>
<?php endif; ?>