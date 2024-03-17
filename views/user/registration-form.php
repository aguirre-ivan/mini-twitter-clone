<?php session_start(); ?>
<?php require_once '../partials/head.html'; ?>

<body>
    <?php require_once '../partials/header.html'; ?>

    <div class="registration-form">
        <h1>Sign up</h1>
        <form action="../../controllers/user/register.php" method="post">
            <?php if (isset($_SESSION['registration_error'])) : ?>
                <div class="registration-error">
                    <?php
                    echo $_SESSION['registration_error'];
                    unset($_SESSION['registration_error']);
                    ?>
                </div>
            <?php endif; ?>
            <label for="username">Usuario</label>
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
    </div>

    <?php require_once '../partials/footer.html'; ?>
</body>

</html>