<?php require_once APP . '/views/partials/head.php' ?>

<div class="user-not-logged-in">
    <div class="landing-container container">
        <div class="landing-container__site-branding page-site-branding">
            <i class="fa-brands fa-twitter"></i>
        </div>
        <div class="landing-container__body">
            <h1 class="lh-sm">
                Lo que está pasando ahora
            </h1>
            <div class="register-container">
                <h3>
                    Únete a Twitter hoy mismo.
                </h3>
                <a class="twitter-btn twitter-btn--lightblue" href="/user/register">Crear cuenta</a>
                <p class="register-container__terms">
                    Al registrarte, aceptas los Términos de servicio y la Política de privacidad, incluida la política de Uso de Cookies.
                </p>
            </div>
            <div class="login-container">
                <h3 class="lh-1">
                    ¿Ya tienes una cuenta?
                </h3>
                <a class="twitter-btn twitter-btn--dark" href="/user/login">Iniciar sesión</a>
            </div>
        </div>
    </div>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>