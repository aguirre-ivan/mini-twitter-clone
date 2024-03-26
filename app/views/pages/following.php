<?php require_once APP . '/views/partials/head.php' ?>

<div class="user-logged-in-page profile-page">
    <div class="user-logged-in-page__sidebar-first">
        <?php require_once APP . '/views/partials/left_menu.php' ?>
    </div>
    <div class="user-logged-in-page__main-container">
        <div class="profile-container">
            <div class="profile-container__username"><?= $page_data['user_data']['username'] ?></div>
            <div class="profile-container__email"><?= $page_data['user_data']['email'] ?></div>
        </div>
        <?php require_once APP . '/views/partials/user/users_container.php' ?>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>