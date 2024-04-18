<?php

$header_image = $page_data['user_data']['header_image'] ?? DEFAULT_HEADER_IMG_PATH;
$profile_image = $page_data['user_data']['profile_image'] ?? DEFAULT_PROFILE_IMG_PATH;
$user_id = $page_data['user_data']['id'];

?>

<div class="profile-container">
    <div class="profile-container__header-image">
        <img src="<?= IMG_DIRECTORY . $header_image ?>">
    </div>
    <div class="profile-container__profile-image">
        <img src="<?= IMG_DIRECTORY . $profile_image ?>">
    </div>
    <div class="profile-container__name"><?= $page_data['user_data']['name'] ?></div>
    <div class="profile-container__username"><?= $page_data['user_data']['username'] ?></div>
    <div class="profile-container__bio"><?= $page_data['user_data']['bio'] ?></div>
    <div class="profile-container__location"><?= $page_data['user_data']['location'] ?></div>
    <?php if (isset($page_data['following_count']) && isset($page_data['followers_count'])) : ?>
        <a href="/user/profile/<?= $user_id ?>/following" class="profile-container__following"><?= $page_data['following_count'] ?> siguiendo</a>
        <a href="/user/profile/<?= $user_id ?>/following" class="profile-container__followers"><?= $page_data['followers_count'] ?> seguidores</a>
        <a class="profile-container__button" href="<?= $page_data['profile_button']['link'] ?>" class="profile-container__edit-link">
            <?= $page_data['profile_button']['text'] ?>
        </a>
    <?php else : ?>
        <div class="profile-container__follow-title">
            <?= $page_data['title'] ?>
        </div>
    <?php endif; ?>
</div>