<?php

define('ACTIONHBG_PATH', get_stylesheet_directory() . '/');

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

//Include theme functions
require_once ACTIONHBG_PATH . 'library/Vendor/Psr4ClassLoader.php';
$loader = new ACTIONHBG\Vendor\Psr4ClassLoader();
$loader->addPrefix('ActionHbg', ACTIONHBG_PATH . 'library');
$loader->addPrefix('ActionHbg', ACTIONHBG_PATH . 'source/php/');
$loader->register();

new ActionHbg\App();