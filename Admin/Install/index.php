<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Framework/Autoloader.php';

$dbHOBJ = new \Framework\DataStorage\Database\Pool();
$dbHOBJ->create('core', $CONFIG['db']);
$instHOBJ = new \Framework\Install\Install($dbHOBJ);

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
    'Calendar',
    'Marketing',
    'HumanResources',
    'ResearchDevelopment',
    'Production',
    'Surveys',
    'Tasks',
    'Messages',
    'ProjectManagement',
    'EventManagement',
    'Chat',
    'News',*/
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
