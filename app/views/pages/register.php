<?php require_once APP . '/views/partials/head.php' ?>
<?php require_once APP . '/views/partials/header.php' ?>

<div class="registration-page container">
        <div class="registration-page__site-branding page-site-branding">
            <a href="/index">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                    <path fill="#FFFFFF" d="M 50.0625 10.4375 C 48.214844 11.257813 46.234375 11.808594 44.152344 12.058594 C 46.277344 10.785156 47.910156 8.769531 48.675781 6.371094 C 46.691406 7.546875 44.484375 8.402344 42.144531 8.863281 C 40.269531 6.863281 37.597656 5.617188 34.640625 5.617188 C 28.960938 5.617188 24.355469 10.21875 24.355469 15.898438 C 24.355469 16.703125 24.449219 17.488281 24.625 18.242188 C 16.078125 17.8125 8.503906 13.71875 3.429688 7.496094 C 2.542969 9.019531 2.039063 10.785156 2.039063 12.667969 C 2.039063 16.234375 3.851563 19.382813 6.613281 21.230469 C 4.925781 21.175781 3.339844 20.710938 1.953125 19.941406 C 1.953125 19.984375 1.953125 20.027344 1.953125 20.070313 C 1.953125 25.054688 5.5 29.207031 10.199219 30.15625 C 9.339844 30.390625 8.429688 30.515625 7.492188 30.515625 C 6.828125 30.515625 6.183594 30.453125 5.554688 30.328125 C 6.867188 34.410156 10.664063 37.390625 15.160156 37.472656 C 11.644531 40.230469 7.210938 41.871094 2.390625 41.871094 C 1.558594 41.871094 0.742188 41.824219 -0.0585938 41.726563 C 4.488281 44.648438 9.894531 46.347656 15.703125 46.347656 C 34.617188 46.347656 44.960938 30.679688 44.960938 17.09375 C 44.960938 16.648438 44.949219 16.199219 44.933594 15.761719 C 46.941406 14.3125 48.683594 12.5 50.0625 10.4375 Z"></path>
                </svg>
            </a>
        </div>
        <div class="registration-page__form">
            <h1>Registrarse en Twitter</h1>
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
                <input class="twitter-sign-input" type="text" name="username" placeholder="Nombre de usuario">
                <input class="twitter-sign-input" type="email" name="email" placeholder="Correo electrónico">
                <input class="twitter-sign-input" type="password" name="password" placeholder="Contraseña">
                <button class="twitter-btn twitter-btn--lightblue" type="submit">Unirse</button>
            </form>
        </div>
        <div class="registration-page__signin">
            <p>¿Ya tienes cuenta? <a href="/user/login">Iniciá sesion</a></p>
        </div>
    </div>

<?php require_once APP . '/views/partials/footer.php' ?>