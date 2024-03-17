<?php require_once '../partials/head.html'; ?>

<body>
    <?php require_once '../partials/header.html'; ?>

    <div class="container">
        <h1>Register Form</h1>
        <form action="../../controllers/user/register.php" method="post">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>

    </div>

    <?php require_once '../partials/footer.html'; ?>
</body>

</html>