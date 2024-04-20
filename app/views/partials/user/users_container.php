<?php if (!empty($page_data['users'])): ?>
    <div class="users-container">
        <?php foreach ($page_data['users'] as $user): ?>
            <?php
            $profile_image = $user['profile_image'] ?? DEFAULT_PROFILE_IMG_PATH;
            ?>
            <div class="user-container">
                <div class="user-container__image">
                    <img src="<?= IMG_DIRECTORY . $profile_image ?>">
                </div>
                <div class="user-container__body">
                    <div class="user-container__info">
                        <a href="/user/profile/<?= $user['id'] ?>"
                            class="user-container__name"><?= $user['name'] ?></a>
                        <div class="user-container__username"><?= $user['username'] ?></div>
                        <?php if (isset($user['bio'])): ?>
                            <div class="user__bio"><?= $user['bio'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="empty-users-container">Aun no hay usuarios.</div>
<?php endif; ?>