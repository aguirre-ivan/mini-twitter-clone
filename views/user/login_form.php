<?php session_start(); ?>
<?php require_once '../partials/head.html'; ?>

<body>
    <?php require_once '../partials/header.php'; ?>

    <div class="login-form">
        <h1>Iniciar sesion</h1>
        <form action="../../controllers/user/login.php" method="post">
            <?php if (isset($_SESSION['login_error'])) : ?>
                <div class="login-error">
                    <?= $_SESSION['login_error']; ?>
                    <?php unset($_SESSION['login_error']); ?>
                </div>
            <?php endif; ?>
            <label for="username">Usuario</label>
            <input type="text" name="username" placeholder="Nombre de usuario">
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Contraseña">
            <button type="submit">Ingresar</button>
        </form>
    </div>

    <?php require_once '../partials/footer.html'; ?>
</body>

</html>