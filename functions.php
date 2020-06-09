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

//Load fields
add_action('init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('municipio-action');
    $acfExportManager->setExportFolder(ACTIONHBG_PATH . 'library/AcfFields');
    $acfExportManager->autoExport(array(
        'newsreel' => 'group_5ed75801bac03'
    ));
    $acfExportManager->import();
});

new ActionHbg\App();