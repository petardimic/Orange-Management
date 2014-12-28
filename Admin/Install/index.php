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
    'Media',
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

$instHOBJ->installCore();
$instHOBJ->installModules($toInstall);
$instHOBJ->installGroups();
$instHOBJ->installUsers(); /* TODO: create user 1 = Guest -> 2 = Admin */
$instHOBJ->installSettings();

$toDummy = [
    'Media',
    'News',
    'Tasks',
    'HumanResources',
    'Production',
    'Sales',
    'Purchase',
    'Accounting',
];
$instHOBJ->installDummy($toDummy);
