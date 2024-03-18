<?php if (isset($_SESSION['user_id'])) : ?>
    <header class="site-header">
        <nav>
            <ul class="main-menu">
                <li><a href="/controllers/user/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
<?php endif; ?>