<?php if (!empty($page_data['users'])) : ?>
    <div class="users-container">
        <?php foreach ($page_data['users'] as $user) : ?>
            <div class="user">
                <a href="/user/profile/<?= $user['id'] ?>" class="user__username"><?= $user['username'] ?></a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-users-container">Aun no hay usuarios.</div>
<?php endif; ?>