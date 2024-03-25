<?php if (!empty($page_data['users'])) : ?>
    <div class="users-container">
        <?php foreach ($page_data['users'] as $tweet) : ?>
            <div class="user">
                <a href="/user/profile/<?= $username['user_id'] ?>" class="user__username"><?= $tweet['username'] ?></a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-users-container">Aun no hay usuarios.</div>
<?php endif; ?>