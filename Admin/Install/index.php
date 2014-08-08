<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Framework/Core/Database/Database.class.php';
require_once __DIR__ . '/../../Framework/Core/Install.class.php';

$dbHOBJ = new \Framework\Core\Database\Database($DBDATA);
$instHOBJ = new \Framework\Core\Install($dbHOBJ);

$toInstall = [
    'Navigation',
    'Admin',
    'BackendDashboard',
    'Content',
    'GlobalContent',
    'API',
];

$instHOBJ->install_core();
$instHOBJ->install_core_modules($toInstall);
$instHOBJ->install_groups();
$instHOBJ->install_users();
$instHOBJ->install_settings();