<?php require_once APP . '/views/partials/head.php' ?>

<div class="user-access-page registration-form-page container">
    <?php require_once APP . '/views/partials/user/user_access_header.php' ?>

    <div class="user-access-page__body">
        <h1>Registrarse en Twitter</h1>
        <div class="registration-form">
            <form action="" method="post">
                <?php if (isset($page_data['registration_errors'])) : ?>
                    <div class="registration-error alert-box alert-box--error">
                        <ul class="m-0 p-0">
                            <?php foreach ($page_data['registration_errors'] as $error) : ?>
                                <li>
                                    <?= $error; ?>
                                </li>
                            <?php endforeach; ?>
                            <?php unset($page_data['registration_errors']); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <input class="twitter-input" type="text" name="name" placeholder="Nombre">
                <input class="twitter-input" type="text" name="username" placeholder="Nombre de usuario">
                <input class="twitter-input" type="email" name="email" placeholder="Correo electrónico">
                <input class="twitter-input" type="password" name="password" placeholder="Contraseña">
                <button class="twitter-btn twitter-btn--lightblue" type="submit">Unirse</button>
            </form>
        </div>
        <div class="user-signin">
            <p>¿Ya tienes cuenta? <a href="/user/login">Iniciá sesion</a></p>
        </div>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>