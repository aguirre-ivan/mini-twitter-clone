<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('./views/partials/head.html') ?>

<body>
    <?php require_once('./views/partials/header.html') ?>

    <?php
    if (isset($_SESSION['user_id'])) {
        require_once('./views/feed.php');
    } else {
        require_once('./views/user_not_logged_in.php');
    }
    ?>

    <?php require_once('./views/partials/footer.html') ?>
</body>

</html>