<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Framework/Autoloader.class.php';

$dbHOBJ = new \Framework\DataStorage\Database\Database($CONFIG['db']);
$instHOBJ = new \Framework\Install\Install($dbHOBJ);

/**
 * Array with all modules to install
 *
 * @var array toInstall
 */
$toInstall = [
    /* Core */
    'Navigation',
    'Admin',
    'BackendDashboard',
    'Content',
    'GlobalContent',
    'API',
    /* TESTING */
    'News',
    'Tasks',
    'Profile',
    'Production',
    'Purchase',
    'Controlling',
    'RiskManagement',
    'Sales',
    'Surveys',
    'Marketing',
    'Media',
    'Messages',
    'HumanResources',
    'Calendar',
    'Accounting',
    'Warehousing',
    'ProjectManagement',
    'EventManagement',
    'Support',
    'ResearchDevelopment',
];

$instHOBJ->install_core();
$instHOBJ->install_core_modules($toInstall);
$instHOBJ->install_groups();
$instHOBJ->install_users(); /* TODO: create user 1 = Guest -> 2 = Admin */
$instHOBJ->install_settings();
