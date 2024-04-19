<?php

$header_image = $page_data['user_data']['header_image'] ?? DEFAULT_HEADER_IMG_PATH;
$profile_image = $page_data['user_data']['profile_image'] ?? DEFAULT_PROFILE_IMG_PATH;
$user_id = $page_data['user_data']['id'];

$user_created_time = userCreatedTime(strtotime($page_data['user_data']['created_at']));
?>

<div class="profile-container">
    <div class="profile-container__header">
        <div class="header-image">
            <img src="<?= IMG_DIRECTORY . $header_image ?>">
        </div>
        <div class="profile-image">
            <img src="<?= IMG_DIRECTORY . $profile_image ?>">
        </div>
    </div>
    <div class="profile-container__info">
        <div class="profile-container__name"><?= $page_data['user_data']['name'] ?></div>
        <div class="profile-container__username"><?= $page_data['user_data']['username'] ?></div>
        <div class="profile-container__bio"><?= $page_data['user_data']['bio'] ?></div>
        <?php if ($page_data['user_data']['location']) : ?>
            <div class="profile-container__location"><i class="fa-solid fa-location-dot"></i><?= $page_data['user_data']['location'] ?></div>
        <?php endif; ?>
        <div class="profile-container__created-at"><i class="fa-regular fa-calendar-days"></i><?= $user_created_time ?>
        </div>

        <?php if (isset($page_data['following_count']) && isset($page_data['followers_count'])) : ?>
            <a href="/user/profile/<?= $user_id ?>/following" class="profile-container__following"><?= $page_data['following_count'] ?> siguiendo</a>
            <a href="/user/profile/<?= $user_id ?>/followers" class="profile-container__followers"><?= $page_data['followers_count'] ?> seguidores</a>
            <a class="profile-container__button twitter-btn twitter-btn--lightblue" href="<?= $page_data['profile_button']['link'] ?>" class="profile-container__edit-link">
                <?= $page_data['profile_button']['text'] ?>
            </a>
        <?php else : ?>
            <div class="profile-container__follow-title">
                <?= $page_data['title'] ?>
            </div>
        <?php endif; ?>
    </div>
</div>