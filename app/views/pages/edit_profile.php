<?php require_once APP . '/views/partials/head.php' ?>

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
                    <input type="text" id="name" name="name">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="location">Ubicación</label>
                    <input type="text" id="location" name="location">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="header_image">Foto de portada</label>
                    <input type="file" id="header_image" name="header_image">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="profile_image">Foto de Perfil</label>
                    <input type="file" id="profile_image" name="profile_image">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="bio">Biografía</label>
                    <textarea id="bio" name="bio" rows="4" cols="50"></textarea>
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