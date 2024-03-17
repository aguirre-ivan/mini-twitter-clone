<?php session_start(); ?>
<?php require_once '../partials/head.html'; ?>

<body>
    <?php require_once '../partials/header.html'; ?>

    <div class="login-form">
        <h1>Iniciar sesion</h1>
        <form action="../../controllers/user/login.php" method="post">
            <?php if (isset($_SESSION['login_error'])) : ?>
                <div class="login-error">
                    <ul>
                        <?php foreach ($_SESSION['login_error'] as $error) : ?>
                            <li>
                                <?= $error; ?>
                            </li>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['login_error']); ?>
                    </ul>
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