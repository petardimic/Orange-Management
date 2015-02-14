<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../phpOMS/Autoloader.php';

$dbHOBJ = new \phpOMS\DataStorage\Database\Pool();
$dbHOBJ->create('core', $CONFIG['db']);
$instHOBJ = new \phpOMS\Install\Install($dbHOBJ);

/**
 * Array with all modules to install
 *
 * @var array toInstall
 */
$toInstall = [
    /* Core */
    'Content',
    'Navigation',
    'Admin',
    'BackendDashboard',
    'Business',
    'Media',
    'Tasks',
    'News',
    'Calendar',
    'Messages',
    'Reporter',/*
    'ItemReference',
    'Sales',
    'Billing',
    'Purchase',
    'Accounting',
    'AccountsReceivable',
    'AccountsPayable',
    'Controlling',
    'RiskManagement',
    'Marketing',
    'HumanResources',
    'ResearchDevelopment',
    'Production',
    'Surveys',
    'ProjectManagement',
    'EventManagement'*/
];

$instHOBJ->installCore();
$instHOBJ->installModules($toInstall);
$instHOBJ->installGroups();
$instHOBJ->installUsers(); /* TODO: create user 1 = Guest -> 2 = Admin */
$instHOBJ->installSettings();

$toDummy = [
    //'Media',
    //'News',
    //'Tasks',
    //'HumanResources',
    //'Production',
    //'Sales',
    //'Purchase',
    //'Accounting',
];
//$instHOBJ->installDummy($toDummy);
