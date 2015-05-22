<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../phpOMS/Autoloader.php';

$dbHOBJ = new \phpOMS\DataStorage\Database\Pool();
$dbHOBJ->create('core', $CONFIG['db']);
$instHOBJ = new \Admin\Install\Install($dbHOBJ);

/**
 * Array with all modules to install
 *
 * @var array toInstall
 */
$toInstall = [
    //'Accounting',
    //'AccountsPayable',
    //'AccountsReceivable',
    'Admin',
    //'AreaManager',
    //'Arrival',
    //'AssemblyManagement',
    //'Backup',
    //'BankAccounting',
    //'Billing',
    //'BudgetManagement',
    'Business',
    //'BusinessPlanningSimulation',
    'Calendar',
    //'CapacityPlanning',
    //'CashManagement',
    'Chat',
    //'ClientManagement',
    'Clocking',
    'Content',
    'Controlling',
    //'CostCenterAccounting',
    //'CostUnitAccounting',
    //'CreditManagement',
    'Dashboard',
    'EmployeeEvaluation',
    'EmployeeManagement',
    'EventManagement',
    'HumanResourceManagement',
    //'InventoryManagement',
    //'InvoiceManagement',
    //'ItemManagement',
    //'Logistics',
    //'LotTracking',
    //'Marketing',
    'Media',
    'Messages',
    'Monitoring',
    'MyPrivate',
    'Navigation',
    'News',
    //'PaymentInformation',
    //'Payroll',
    //'PersonalCostPlanning',
    'PersonnelTimeManagement',
    //'ProductCostControlling',
    //'Production',
    //'ProductionOrders',
    //'ProductionPlanning',
    'Profile',
    //'ProfitabilityAnalysis',
    //'ProfitCenterAccounting',
    'ProjectManagement',
    //'Purchase',
    //'PurchaseAnalysis',
    //'QualityManagement',
    //'ReceiptManagement',
    'Reporter',
    //'Reporting',
    //'ResearchDevelopment',
    'RiskManagement',
    //'Sales',
    //'SalesAnalysis',
    //'ShiftExchange',
    //'ShiftPlanning',
    //'Shipping',
    //'SupplierEvaluation',
    //'SupplierManagement',
    //'SupplyChainManagement',
    'Support',
    'Surveys',
    'Tasks',
    'Tools',
    'TravelExpenses',
    //'WarehouseManagement',
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
