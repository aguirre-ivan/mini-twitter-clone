<?php if (isset($_SESSION['user_id'])) : ?>
    <header class="site-header">
        <nav>
            <ul class="main-menu">
                <li><a href="/index.php">Inicio</a></li>
                <li><a href="/views/user/profile.php?id=<?php echo $_SESSION['user_id']; ?>">Perfil</a></li>
                <li><a href="/views/user/edit.php">A quien seguir</a></li>
                <li><a href="/controllers/user/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
<?php endif; ?>