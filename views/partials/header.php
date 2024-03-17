<header>
    <nav class="site-header">
        <div class="site-branding">
            <img>
        </div> 
        <ul class="main-menu">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li><a href="/controllers/user/logout.php">Cerrar sesión</a></li>
            <?php else : ?>
                <li><a href="../../index.php">Inicio</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>