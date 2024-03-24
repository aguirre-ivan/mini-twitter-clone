<?php if (isset($_SESSION['user_id'])) : ?>
    <header class="site-header">
        <nav>
            <ul class="main-menu">
                <li><a href="/index">Inicio</a></li>
                <li><a href="/user">Perfil</a></li>
                <li><a href="/user/explore">A quien seguir</a></li>
                <li><a href="/user/logout">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
<?php endif; ?>