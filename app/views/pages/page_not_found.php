<?php

$page_data['title'] = 'Pagina no encontrada / Twitter';
$user_logged_in = isset($_SESSION['user_id']);
$page_not_found_class = $user_logged_in ? 'page-not-found--logged-in' : 'page-not-found--logged-out';

?>

<?php require_once APP . '/views/partials/head.php' ?>

<div class="page-not-found <?= $page_not_found_class ?>">
    <?php if ($user_logged_in) : ?>
        <div class="page-not-found__sidebar-first sidebar-first">
            <?php require_once APP . '/views/partials/left_menu.php' ?>
        </div>
    <?php endif; ?>
    <div class="page-not-found__main-container">
        <?php if (!$user_logged_in) : ?>
            <div class="user-access-page__site-branding">
                <a href="/index">
                    <i class="fa-brands fa-twitter"></i>
                </a>
            </div>
        <?php endif; ?>
        <h1>404 - Página no encontrada</h1>
        <p>La página que estas buscando no se encuentra.</p>
        <p>Clickeá <a href="/">acá</a> para volver a la página principal.</p>
    </div>
    <?php if ($user_logged_in) : ?>
        <div class="page-not-found__sidebar-second sidebar-second">
            <?php require_once APP . '/views/partials/project_info.php' ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once APP . '/views/partials/footer.php' ?>