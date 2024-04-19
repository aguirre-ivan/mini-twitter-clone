<?php require_once APP . '/views/partials/head.php' ?>

<div class="user-logged-in-page profile-page">
    <div class="user-logged-in-page__sidebar-first sidebar-first">
        <?php require_once APP . '/views/partials/left_menu.php' ?>
    </div>
    <div class="user-logged-in-page__main-container">
        <?php require_once APP . '/views/partials/user/profile_container.php' ?>
        <?php require_once APP . '/views/partials/user/users_container.php' ?>
    </div>
    <div class="user-logged-in-page__sidebar-second sidebar-second">
        <?php require_once APP . '/views/partials/project_info.php' ?>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>