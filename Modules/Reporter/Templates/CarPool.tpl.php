<?php
/**
 * @var \phpOMS\Views\View $this
 */

$tabView = new \Web\Views\Divider\TabularView($this->l11n);
$tabView->setTemplate('/Web/Theme/Templates/Divider/Tabular');

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);
?>

<?= $nav->getOutput(); ?>

<?php
/*
 * UI Logic
 */
$overviewBasicList           = new \Web\Views\Lists\ListView($this->l11n);
$overviewBasicListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$overviewBasicList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$overviewBasicListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewBasicListHeaderView->setTitle('Basic');
$overviewBasicListHeaderView->setHeader([
    ['title' => 'Cars', 'sortable' => true],
    ['title' => 'Leasing', 'sortable' => true],
    ['title' => 'Plan', 'sortable' => true],
    ['title' => 'Current', 'sortable' => true],
    ['title' => 'Forecast', 'sortable' => true],
    ['title' => 'History', 'sortable' => true],
]);

$overviewBasicList->setFreeze(1, 0);
$overviewBasicList->addView('header', $overviewBasicListHeaderView);

/*
 * UI Logic
 */
$overviewCompareList           = new \Web\Views\Lists\ListView($this->l11n);
$overviewCompareListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$overviewCompareList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$overviewCompareListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewCompareListHeaderView->setTitle('Comparison');
$overviewCompareListHeaderView->setHeader([
    ['title' => 'Account', 'sortable' => true],
    ['title' => 'Description', 'sortable' => true],
    ['title' => 'Plan', 'sortable' => true],
    ['title' => 'Current', 'sortable' => true],
    ['title' => 'Forecast', 'sortable' => true],
    ['title' => 'History', 'sortable' => true],
]);

$overviewCompareList->setFreeze(1, 0);
$overviewCompareList->addView('header', $overviewCompareListHeaderView);

$graphProgressView = new \Web\Views\Panel\PanelView($this->l11n);
$graphProgressView->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');
$graphProgressView->setTitle('Progress');

$graphComparisonView = new \Web\Views\Panel\PanelView($this->l11n);
$graphComparisonView->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');
$graphComparisonView->setTitle('Comparison');

$tabView->addTab('Overview', $overviewBasicList->getOutput() . $overviewCompareList->getOutput() . $graphProgressView->getOutput() . $graphComparisonView->getOutput(), 'overview');

/*
 * UI Logic
 */
$carsList           = new \Web\Views\Lists\ListView($this->l11n);
$carsListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$carsList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$carsListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$carsListHeaderView->setTitle('Cars');
$carsListHeaderView->setHeader([
    ['title' => 'ID', 'sortable' => true],
    ['title' => 'Description', 'sortable' => true],
    ['title' => 'Owner', 'sortable' => true, 'full' => true],
    ['title' => 'Leasing', 'sortable' => true],
    ['title' => 'Tax', 'sortable' => true],
    ['title' => 'Rep./Insp.', 'sortable' => true],
    ['title' => 'Wheels', 'sortable' => true],
    ['title' => 'Misc', 'sortable' => true],
    ['title' => 'Begin', 'sortable' => true],
    ['title' => 'LeasingBegin', 'sortable' => true],
    ['title' => 'LeasingEnd', 'sortable' => true],
    ['title' => 'Sold', 'sortable' => true],
]);

$carsList->setFreeze(1, 0);
$carsList->addView('header', $carsListHeaderView);
$tabView->addTab('Cars', $carsList->getOutput(), 'cars');

/*
 * UI Logic
 */
$historyList           = new \Web\Views\Lists\ListView($this->l11n);
$historyListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$historyList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$historyListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$historyListHeaderView->setTitle('History');
$historyListHeaderView->setHeader([
    ['title' => 'ID', 'sortable' => true],
    ['title' => 'Owner', 'sortable' => true, 'full' => true],
    ['title' => 'Leasing', 'sortable' => true],
    ['title' => 'Tax', 'sortable' => true],
    ['title' => 'Rep./Insp.', 'sortable' => true],
    ['title' => 'Wheels', 'sortable' => true],
    ['title' => 'Gas', 'sortable' => true],
    ['title' => 'Misc', 'sortable' => true],
    ['title' => 'Sum', 'sortable' => true],
    ['title' => 'Diff', 'sortable' => true],
    ['title' => 'Leasing', 'sortable' => true],
    ['title' => 'Tax', 'sortable' => true],
    ['title' => 'Rep./Insp.', 'sortable' => true],
    ['title' => 'Wheels', 'sortable' => true],
    ['title' => 'Gas', 'sortable' => true],
    ['title' => 'Misc', 'sortable' => true],
    ['title' => 'Sum', 'sortable' => true],
    ['title' => 'Diff', 'sortable' => true],
    ['title' => 'Leasing', 'sortable' => true],
    ['title' => 'Tax', 'sortable' => true],
    ['title' => 'Rep./Insp.', 'sortable' => true],
    ['title' => 'Wheels', 'sortable' => true],
    ['title' => 'Gas', 'sortable' => true],
    ['title' => 'Misc', 'sortable' => true],
    ['title' => 'Sum', 'sortable' => true],
]);

$historyList->setFreeze(1, 2);
$historyList->addView('header', $historyListHeaderView);
$tabView->addTab('History', $historyList->getOutput(), 'history');

/*
 * UI Logic
 */
$planningList           = new \Web\Views\Lists\ListView($this->l11n);
$planningListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$planningList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$planningListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$planningListHeaderView->setTitle('Plan');
$planningListHeaderView->setHeader([
    ['title' => 'ID', 'sortable' => true],
    ['title' => 'Owner', 'sortable' => true, 'full' => true],
    ['title' => 'Leasing', 'sortable' => true],
    ['title' => 'Tax', 'sortable' => true],
    ['title' => 'Rep./Insp.', 'sortable' => true],
    ['title' => 'Wheels', 'sortable' => true],
    ['title' => 'Gas', 'sortable' => true],
    ['title' => 'Misc', 'sortable' => true],
    ['title' => 'Sum', 'sortable' => true],
    ['title' => 'Diff', 'sortable' => true],
    ['title' => 'Leasing', 'sortable' => true],
    ['title' => 'Tax', 'sortable' => true],
    ['title' => 'Rep./Insp.', 'sortable' => true],
    ['title' => 'Wheels', 'sortable' => true],
    ['title' => 'Gas', 'sortable' => true],
    ['title' => 'Misc', 'sortable' => true],
    ['title' => 'Sum', 'sortable' => true],
    ['title' => 'Diff', 'sortable' => true],
    ['title' => 'Leasing', 'sortable' => true],
    ['title' => 'Tax', 'sortable' => true],
    ['title' => 'Rep./Insp.', 'sortable' => true],
    ['title' => 'Wheels', 'sortable' => true],
    ['title' => 'Gas', 'sortable' => true],
    ['title' => 'Misc', 'sortable' => true],
    ['title' => 'Sum', 'sortable' => true],
]);

$planningList->setFreeze(3, 2);
$planningList->addView('header', $planningListHeaderView);
$tabView->addTab('Planning', $planningList->getOutput(), 'planning');
?>
<?= $tabView->getOutput(); ?>