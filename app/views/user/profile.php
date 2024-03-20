<?php
session_start();
require_once '../../controllers/user/profile.php';
require_once '../partials/head.html';
?>

<body>
    <?php require_once '../partials/header.php'; ?>
    <div class="profile-page-container container">
        <div class="profile-container">
            <div class="profile-container__username"><?= $user_data['username'] ?></div>
            <div class="profile-container__email"><?= $user_data['email'] ?></div>
        </div>
        <?php require_once '../tweet/tweets_by_user.php'; ?>
    </div>
    <?php require_once '../partials/footer.html'; ?>
</body>

</html>