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
    'Accounting',
    'AccountsPayable',
    'AccountsReceivable',
    'Admin',
    'AreaManager',
    'Arrival',
    'AssemblyManagement',
    'BackendDashboard',
    'Backup',
    'BankAccounting',
    'Billing',
    'Budgeting',
    'BudgetManagement',
    'Business',
    'BusinessPlanningSimulation',
    'Calendar',
    'CapacityPlanning',
    'CashManagement',
    'Chat',
    'Clocking',
    'Content',
    'Controlling',
    'CostCenterAccounting',
    'CostUnitAccounting',
    'CreditManagement',
    'EmployeeEvaluation',
    'EmployeeManagement',
    'EventManagement',
    'HumanResources',
    'InventoryManagement',
    'InvoiceManagement',
    'ItemReference',
    'Logistics',
    'LotTracking',
    'Marketing',
    'Media',
    'Messages',
    'Monitoring',
    'Navigation',
    'News',
    'PaymentInformation',
    'Payroll',
    'PersonalCostPlanning',
    'PersonnelTimeManagement',
    'ProductCostControlling',
    'Production',
    'ProductionOrders',
    'ProductionPlanning',
    'Profile',
    'ProfitabilityAnalysis',
    'ProfitCenterAccounting',
    'ProjectManagement',
    'Purchase',
    'PurchaseAnalysis',
    'QualityManagement',
    'ReceiptManagement',
    'Reporter',
    'Reporting',
    'ResearchDevelopment',
    'RiskManagement',
    'Sales',
    'SalesAnalysis',
    'ShiftExchange',
    'ShiftPlanning',
    'Shipping',
    'SupplierEvaluation',
    'SupplyChainManagement',
    'Support',
    'Surveys',
    'Tasks',
    'TravelExpenses',
    'Treasury',
    'WarehouseManagement',
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
