<?php require_once APP . '/views/partials/head.php' ?>

<div class="user-access-page login-form-page container">
    <?php require_once APP . '/views/partials/user/user_access_header.php' ?>

    <div class="user-access-page__body">
        <h1>Inicia sesión en Twitter</h1>
        <div class="login-form">
            <form action="" method="post">
                <?php if (isset($page_data['login_errors'])) : ?>
                    <div class="registration-error alert-box alert-box--error">
                        <ul class="m-0 p-0">
                            <?php foreach ($page_data['login_errors'] as $error) : ?>
                                <li>
                                    <?= $error; ?>
                                </li>
                            <?php endforeach; ?>
                            <?php unset($page_data['login_errors']); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <input class="twitter-sign-input" type="text" name="username" placeholder="Nombre de usuario">
                <input class="twitter-sign-input" type="password" name="password" placeholder="Contraseña">
                <button class="twitter-btn twitter-btn--lightblue" type="submit">Ingresar</button>
            </form>
        </div>
        <div class="user-signup">
            <p>¿No tienes cuenta? <a href="/user/register">Regístrate</a></p>
        </div>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>