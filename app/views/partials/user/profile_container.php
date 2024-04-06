<div class="profile-container">
    <div class="profile-container__name"><?= $page_data['user_data']['name'] ?></div>
    <div class="profile-container__username"><?= $page_data['user_data']['username'] ?></div>
    <a class="profile-container__button" href="<?= $page_data['profile_button']['link'] ?>" class="profile-container__edit-link">
        <?= $page_data['profile_button']['text'] ?>
    </a>
</div>