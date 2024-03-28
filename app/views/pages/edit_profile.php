<?php require_once APP . '/views/partials/head.php' ?>

<div class="user-logged-in-page profile-page">
    <div class="user-logged-in-page__sidebar-first">
        <?php require_once APP . '/views/partials/left_menu.php' ?>
    </div>
    <div class="user-logged-in-page__main-container">
        <h1>Editar perfil</h1>
        <form action="/user/update" method="post" class="form">
            TODO - Add form fields
        </form>
    </div>
    <div class="user-logged-in-page__sidebar-first">
        <?php require_once APP . '/views/partials/project_info.php' ?>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>