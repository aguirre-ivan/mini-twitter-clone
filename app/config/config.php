<?php

define('APP', dirname(__DIR__));

define('UPLOAD_IMG_DIRECTORY', realpath(APP . '/../public/files/images/') . '/');
define('MAX_UPLOAD_SIZE_MB', 10);

define('DEFAULT_HEADER_IMG_PATH', 'default/default_header.jpg');
define('DEFAULT_PROFILE_IMG_PATH', 'default/default_profile.jpg');

define('DB_HOST', 'mariadb');
define('DB_NAME', 'mini_twitter');
define('DB_USER', 'root');
define('DB_PASS', 'XXXXX');