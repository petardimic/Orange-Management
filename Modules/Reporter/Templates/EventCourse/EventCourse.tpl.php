<?php
/**
 * @var \phpOMS\Views\View $this
 */

$tabView = new \Web\Views\Divider\TabularView($this->l11n);
$tabView->setTemplate('/Web/Theme/Templates/Divider/Tabular');
$lang = $this->getData('lang');

$year  = 2015;
$month = 3;

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
$overviewCompareList           = new \Web\Views\Lists\ListView($this->l11n);
$overviewCompareListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$overviewCompareList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$overviewCompareListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewCompareListHeaderView->setTitle($lang['Budget']);
$overviewCompareListHeaderView->setHeader([
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Plan'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['DiffPlan'], 'sortable' => true],
]);

$overviewCompareList->setFreeze(1, 2);

$overviewCompareList->addElements([
    'EventCourseInt',
    '?',
    number_format($accountData[$year][4574], 2),
    number_format($accountData[$year][4574] / $month * 12, 2),
    number_format($accountData[$year - 1][4574], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    'EventCourse',
    '?',
    number_format($accountData[$year][4340], 2),
    number_format($accountData[$year][4340] / $month * 12, 2),
    number_format($accountData[$year - 1][4340], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    'Demo',
    '?',
    number_format($accountData[$year][4573], 2),
    number_format($accountData[$year][4573] / $month * 12, 2),
    number_format($accountData[$year - 1][4573], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    'Briefing',
    '?',
    number_format($accountData[$year][4575], 2),
    number_format($accountData[$year][4575] / $month * 12, 2),
    number_format($accountData[$year - 1][4575], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    'Advice',
    '?',
    number_format($accountData[$year][4572], 2),
    number_format($accountData[$year][4572] / $month * 12, 2),
    number_format($accountData[$year - 1][4572], 2),
    '100.00%'
]);

$overviewCompareList->addView('header', $overviewCompareListHeaderView);

/*
 * UI Logic
 */
/* TODO: Costs/Success for all */
$overviewTypeListView           = new \Web\Views\Lists\ListView($this->l11n);
$overviewTypeListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$overviewTypeListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$overviewTypeListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewTypeListHeaderView->setTitle($lang['CostObject']);
$overviewTypeListHeaderView->setHeader([
    ['title' => $lang['Type'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
]);

$overviewTypeListView->setFreeze(1, 2);

$overviewTypeListView->addElements([
    'A',
    'EventCourseInt',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'B',
    'Advice',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'D',
    'Demo',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'E',
    'Briefing',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'I',
    'IMPLA',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'K',
    'Course',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'M',
    'MarketingSupport',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'P',
    'Promotion',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'R',
    'Course Rosbach',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'S',
    'Roadshow',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'U',
    'AdditionalSupport',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    'V',
    'Event',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addElements([
    '#',
    'Unassigned',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addView('header', $overviewTypeListHeaderView);

/*
 * UI Logic
 */
$overviewCostCenterView           = new \Web\Views\Lists\ListView($this->l11n);
$overviewCostCenterHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$overviewCostCenterView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$overviewCostCenterHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewCostCenterHeaderView->setTitle($lang['CostCenter']);
$overviewCostCenterHeaderView->setHeader([
    ['title' => $lang['Type'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
]);

$overviewCostCenterView->setFreeze(1, 2);

$overviewCostCenterView->addElements([
    '111',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '121',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '131',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '161',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '162',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '171',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '233',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '241',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '5800',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addElements([
    '3300',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewCostCenterView->addView('header', $overviewCostCenterHeaderView);

/*
 * UI Logic
 */
$overviewAccountView           = new \Web\Views\Lists\ListView($this->l11n);
$overviewAccountHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$overviewAccountView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$overviewAccountHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewAccountHeaderView->setTitle($lang['Account']);
$overviewAccountHeaderView->setHeader([
    ['title' => $lang['Type'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
]);

$overviewAccountView->setFreeze(1, 2);

$overviewAccountView->addElements([
    '4480',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4481',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4482',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4483',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4484',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4485',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4490',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4490',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4490',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addElements([
    '4490',
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewAccountView->addView('header', $overviewAccountHeaderView);

$graphProgressView = new \Web\Views\Panel\PanelView($this->l11n);
$graphProgressView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$graphProgressView->setTitle($lang['Progress']);

$tabView->addTab($lang['Overview'], $overviewCompareList->getOutput() . $overviewTypeListView->getOutput() . $overviewCostCenterView->getOutput() . $overviewAccountView->getOutput() . $graphProgressView->getOutput(), 'overview');

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
$carsListHeaderView->setTitle($lang['Cars']);
$carsListHeaderView->setHeader([
    ['title' => $lang['ID'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Begin'], 'sortable' => true],
    ['title' => $lang['LeasingBegin'], 'sortable' => true],
    ['title' => $lang['LeasingEnd'], 'sortable' => true],
    ['title' => $lang['Sold'], 'sortable' => true],
]);

$carsList->setFreeze(1, 0);
$carsList->addView('header', $carsListHeaderView);

$carsList->setElements($cars);

$tabView->addTab($lang['CostObject'], $carsList->getOutput(), 'cars');

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
$historyListHeaderView->setTitle($lang['History']);
$historyListHeaderView->setHeader([
    ['title' => $lang['ID'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
]);

$historyList->setFreeze(1, 1);
$historyList->addView('header', $historyListHeaderView);

// tODO: add headline sum

$sum1 = $accountData[$year][4574] + $accountData[$year][4340] + $accountData[$year][4573] + $accountData[$year][4575] + $accountData[$year][4572] + $accountData[$year][4580];
$sum2 = $accountData[$year - 1][4574] + $accountData[$year - 1][4340] + $accountData[$year - 1][4573] + $accountData[$year - 1][4575] + $accountData[$year - 1][4572] + $accountData[$year - 1][4580];
$sum3 = $accountData[$year - 2][4574] + $accountData[$year - 2][4340] + $accountData[$year - 2][4573] + $accountData[$year - 2][4575] + $accountData[$year - 2][4572] + $accountData[$year - 2][4580];

$diff1 = ($sum2 != 0 ? ($sum1 - $sum2) / $sum2 : 'NA');
$diff2 = ($sum3 != 0 ? ($sum2 - $sum3) / $sum3 : 'NA');

$historyList->addElements([
    'SUM',
    number_format($accountData[$year][4574], 2),
    number_format($accountData[$year][4340], 2),
    number_format($accountData[$year][4573], 2),
    number_format($accountData[$year][4575], 2),
    number_format($accountData[$year][4572], 2),
    number_format($accountData[$year][4580], 2),
    number_format($sum1, 2),
    number_format(number_format($diff1 * 100, 2), 2) . '%',
    number_format($accountData[$year - 1][4574], 2),
    number_format($accountData[$year - 1][4340], 2),
    number_format($accountData[$year - 1][4573], 2),
    number_format($accountData[$year - 1][4575], 2),
    number_format($accountData[$year - 1][4572], 2),
    number_format($accountData[$year - 1][4580], 2),
    number_format($sum2, 2),
    number_format(number_format($diff2 * 100, 2), 2) . '%',
    number_format($accountData[$year - 2][4574], 2),
    number_format($accountData[$year - 2][4340], 2),
    number_format($accountData[$year - 2][4573], 2),
    number_format($accountData[$year - 2][4575], 2),
    number_format($accountData[$year - 2][4572], 2),
    number_format($accountData[$year - 2][4580], 2),
    number_format($sum3, 2),
]);

$tabView->addTab($lang['CostCenter'], $historyList->getOutput(), 'history');

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
$planningListHeaderView->setTitle($lang['Plan']);
$planningListHeaderView->setHeader([
    ['title' => $lang['ID'], 'sortable' => true],
    ['title' => $lang['Owner'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
]);

$planningList->setFreeze(3, 2);
$planningList->addView('header', $planningListHeaderView);
$tabView->addTab($lang['Account'], $planningList->getOutput(), 'planning');

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
$planningListHeaderView->setTitle($lang['EventCourse']);
$planningListHeaderView->setHeader([
    ['title' => $lang['ID'], 'sortable' => true],
    ['title' => $lang['Owner'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
    ['title' => $lang['Leasing'], 'sortable' => true],
    ['title' => $lang['Tax'], 'sortable' => true],
    ['title' => $lang['Rep./Insp.'], 'sortable' => true],
    ['title' => $lang['Wheels'], 'sortable' => true],
    ['title' => $lang['Gas'], 'sortable' => true],
    ['title' => $lang['Misc'], 'sortable' => true],
    ['title' => $lang['Sum'], 'sortable' => true],
]);

$planningList->setFreeze(3, 2);
$planningList->addView('header', $planningListHeaderView);
$tabView->addTab($lang['EventCourse'], $planningList->getOutput(), 'eventcourse');
?>
<?= $tabView->getOutput(); ?>