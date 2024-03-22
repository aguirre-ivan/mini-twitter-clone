<?php require_once APP . '/views/partials/head.php' ?>
<?php require_once APP . '/views/partials/header.php' ?>

<div class="profile-page-container container">
    <div class="profile-container">
        <div class="profile-container__username"><?= $page_data['user_data']['username'] ?></div>
        <div class="profile-container__email"><?= $page_data['user_data']['email'] ?></div>
    </div>
    <!-- todo require user tweets -->
</div>

<?php require_once APP . '/views/partials/footer.php' ?>