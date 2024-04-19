<?php
$profile_image = $page_data['user_data']['profile_image'] ?? DEFAULT_PROFILE_IMG_PATH;
?>

<?php if (!empty($page_data['users'])) : ?>
    <div class="users-container">
        <?php foreach ($page_data['users'] as $user) : ?>
            <div class="user-container">
                <div class="user-container__image">
                    <img src="<?= IMG_DIRECTORY . $profile_image ?>">
                </div>
                <div class="user-container__body">
                    <a href="/user/profile/<?= $user['id'] ?>" class="user__name"><?= $user['name'] ?></a>
                    <div class="user__username"><?= $user['username'] ?></div>
                    <div class="user__bio"><?= $user['bio'] ?></div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="empty-users-container">Aun no hay usuarios.</div>
<?php endif; ?>