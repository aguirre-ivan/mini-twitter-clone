<?php session_start(); ?>
<?php require_once '../partials/head.html'; ?>
<body>
    <?php require_once '../partials/header.php'; ?>

    <div class="registration-form">
        <h1>Registrarse</h1>
        <form action="../../controllers/user/register.php" method="post">
            <?php if (isset($_SESSION['registration_error'])) : ?>
                <div class="registration-error">
                    <ul>
                        <?php foreach ($_SESSION['registration_error'] as $error) : ?>
                            <li>
                                <?= $error; ?>
                            </li>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['registration_error']); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <label for="username">Usuario</label>
            <input type="text" name="username" placeholder="Nombre de usuario">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" placeholder="Correo electrónico">
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Contraseña">
            <button type="submit">Unirse</button>
        </form>
    </div>

    <?php require_once '../partials/footer.html'; ?>
</body>

</html>