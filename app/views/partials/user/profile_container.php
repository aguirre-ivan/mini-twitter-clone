<div class="profile-container">
    <div class="profile-container__username"><?= $page_data['user_data']['username'] ?></div>
    <div class="profile-container__email"><?= $page_data['user_data']['email'] ?></div>
    <a class="profile-container__button" href="/user/profile/<?= $page_data['user_data']['id'] ?>/<?= $page_data['profile_button']['method'] ?>" class="profile-container__edit-link">
        <?= $page_data['profile_button']['text'] ?>
    </a>
</div>