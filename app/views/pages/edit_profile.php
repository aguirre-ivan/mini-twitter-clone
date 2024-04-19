<?php

$profile_image = $page_data['user_data']['profile_image'] ?? DEFAULT_PROFILE_IMG_PATH;
$header_image = $page_data['user_data']['header_image'] ?? DEFAULT_HEADER_IMG_PATH;

?>

<?php require_once APP . '/views/partials/head.php' ?>

<!-- <?php var_dump($page_data['user_data']); ?> -->

<div class="user-logged-in-page edit-profile-page">
    <div class="user-logged-in-page__sidebar-first sidebar-first">
        <?php require_once APP . '/views/partials/left_menu.php' ?>
    </div>
    <div class="user-logged-in-page__main-container">
        <div class="back-profile-link">
            <a href="/user">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1>Editar perfil</h1>
        </div>
        <div class="edit-profile-header">
            <div class="edit-profile-header__profile-header">
                <img src="<?= IMG_DIRECTORY . $header_image ?>"
                    alt="Foto de portada">
            </div>
            <div class="edit-profile-header__profile-img">
                <img src="<?= IMG_DIRECTORY . $profile_image ?>"
                    alt="Foto de perfil">
            </div>
            <div class="edit-profile-header__profile-name">
                <h2><?= $page_data['user_data']['name'] ?></h2>
                <p class="m-0">@<?= $page_data['user_data']['username'] ?></p>
            </div>
        </div>
        <div class="edit-profile-form">
            <?php if (!empty($page_data['errors'])) : ?>
            <div class="edit-error alert-box alert-box--error">
                <ul class="m-0 p-0">
                    <?php foreach ($page_data['errors'] as $error) : ?>
                    <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            <form action=""
                method="POST"
                enctype="multipart/form-data">
                <div class="edit-profile-form__item-container">
                    <label for="name">Nombre</label>
                    <input class="twitter-input"
                        type="text"
                        id="name"
                        value="<?= $page_data['user_data']['name'] ?>"
                        name="name">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="location">Ubicación</label>
                    <input class="twitter-input"
                        type="text"
                        id="location"
                        value="<?= $page_data['user_data']['location'] ?>"
                        name="location">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="headerImage">Foto de portada</label>
                    <input class="twitter-input"
                        type="file"
                        id="headerImage"
                        name="headerImage">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="profileImage">Foto de Perfil</label>
                    <input class="twitter-input"
                        type="file"
                        id="profileImage"
                        name="profileImage">
                </div>

                <div class="edit-profile-form__item-container">
                    <label for="bio">Biografía</label>
                    <textarea class="twitter-input"
                        id="bio"
                        name="bio"
                        rows="4"
                        cols="50"><?= $page_data['user_data']['bio'] ?></textarea>
                </div>

                <button class="twitter-btn twitter-btn--lightblue"
                    type="submit">Guardar</button>
            </form>
        </div>
    </div>
    <div class="user-logged-in-page__sidebar-second sidebar-second">
        <?php require_once APP . '/views/partials/project_info.php' ?>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>