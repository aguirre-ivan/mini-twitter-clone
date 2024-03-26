<?php require_once APP . '/views/partials/head.php' ?>

<div class="user-logged-in-page feed-page">
    <div class="user-logged-in-page__sidebar-first">
        <?php require_once APP . '/views/partials/left_menu.php' ?>
    </div>
    <div class="user-logged-in-page__main-container">
        <?php require_once APP . '/views/partials/tweet/add_form.php' ?>
        <?php require_once APP . '/views/partials/tweet/tweets.php' ?>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>