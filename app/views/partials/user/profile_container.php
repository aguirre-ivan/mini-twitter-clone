<?php

$header_image = $page_data['user_data']['header_image'] ?? DEFAULT_HEADER_IMG_PATH;
$profile_image = $page_data['user_data']['profile_image'] ?? DEFAULT_PROFILE_IMG_PATH;

?>

<div class="profile-container">
    <div class="profile-container__header-image">
        <img src="/files/images/<?= $header_image ?>">
    </div>
    <div class="profile-container__profile-image">
        <img src="/files/images/<?= $profile_image ?>">
    </div>
    <div class="profile-container__name"><?= $page_data['user_data']['name'] ?></div>
    <div class="profile-container__username"><?= $page_data['user_data']['username'] ?></div>
    <div class="profile-container__bio"><?= $page_data['user_data']['bio'] ?></div>
    <div class="profile-container__location"><?= $page_data['user_data']['location'] ?></div>
    <a class="profile-container__button" href="<?= $page_data['profile_button']['link'] ?>" class="profile-container__edit-link">
        <?= $page_data['profile_button']['text'] ?>
    </a>
</div>