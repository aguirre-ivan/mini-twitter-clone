<?php

$index_active_class = $page_data['feed_type'] === 'index' ? 'active' : '';
$following_active_class = $page_data['feed_type'] === 'following' ? 'active' : '';

?>

<nav class="feed-header">
    <ul>
        <li>
            <a class="<?= $index_active_class ?>" href="/index/feed">
                <div class="feed-header__link-container">Inicio</div>
            </a>
        </li>
        <li>
            <a class="<?= $following_active_class ?>" href="/index/following">
                <div class="feed-header__link-container">Siguiendo</div>
            </a>
        </li>
    </ul>
</nav>