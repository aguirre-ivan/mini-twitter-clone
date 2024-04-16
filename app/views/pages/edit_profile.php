<?php require_once APP . '/views/partials/head.php' ?>

<?php var_dump($page_data['errors']); ?>

<div class="user-logged-in-page edit-profile-page">
    <div class="user-logged-in-page__sidebar-first">
        <?php require_once APP . '/views/partials/left_menu.php' ?>
    </div>
    <div class="user-logged-in-page__main-container">
        <h1>Editar perfil</h1>
        <div class="edit-profile-form">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="edit-profile-form__item-container">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" value="<?= $page_data['user_data']['name'] ?>" name="name">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="location">Ubicación</label>
                    <input type="text" id="location" value="<?= $page_data['user_data']['location'] ?>" name="location">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="headerImage">Foto de portada</label>
                    <input type="file" id="headerImage" name="headerImage">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="profileImage">Foto de Perfil</label>
                    <input type="file" id="profileImage" name="profileImage">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="bio">Biografía</label>
                    <textarea id="bio" name="bio" rows="4" cols="50"><?= $page_data['user_data']['bio'] ?></textarea>
                </div>

                <button class="twitter-btn twitter-btn--lightblue" type="submit">Guardar</button>
            </form>
        </div>
    </div>
    <div class="user-logged-in-page__sidebar-first">
        <?php require_once APP . '/views/partials/project_info.php' ?>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>