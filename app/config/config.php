<?php

// Path to the application directory
define('APP', dirname(__DIR__));

// Path to the directory where uploaded images will be stored
define('UPLOAD_IMG_DIRECTORY', realpath(APP . '/../public/files/images/') . '/');

// Path to the directory where uploaded images will be stored (from the public directory)
define('IMG_DIRECTORY', '/files/images/');

// Maximum allowed size for uploaded images (in megabytes)
define('MAX_UPLOAD_SIZE_MB', 10);

// Default path for the default header image
define('DEFAULT_HEADER_IMG_PATH', 'default/default_header.jpg');

// Default path for the default profile image
define('DEFAULT_PROFILE_IMG_PATH', 'default/default_profile.jpg');

// Database configuration: host, database name, username, and password
define('DB_HOST', 'mariadb');
define('DB_NAME', 'mini_twitter');
define('DB_USER', 'root');
define('DB_PASS', 'XXXXX');
