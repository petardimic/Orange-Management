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
$overviewCompareListHeaderView->setTitle($lang['Comparison']);
$overviewCompareListHeaderView->setHeader([
    ['title' => $lang['Type'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Plan'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['DiffPlan'], 'sortable' => true],
]);

$overviewCompareList->setFreeze(1, 2);

$overviewCompareList->addElements([
    4574,
    'Leasing',
    '?',
    number_format($accountData[$year][4574], 2),
    number_format($accountData[$year][4574] / $month * 12, 2),
    number_format($accountData[$year - 1][4574], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4340,
    'Taxes',
    '?',
    number_format($accountData[$year][4340], 2),
    number_format($accountData[$year][4340] / $month * 12, 2),
    number_format($accountData[$year - 1][4340], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4573,
    'Rep./Insp.',
    '?',
    number_format($accountData[$year][4573], 2),
    number_format($accountData[$year][4573] / $month * 12, 2),
    number_format($accountData[$year - 1][4573], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4575,
    'Wheels',
    '?',
    number_format($accountData[$year][4575], 2),
    number_format($accountData[$year][4575] / $month * 12, 2),
    number_format($accountData[$year - 1][4575], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4572,
    'Gas',
    '?',
    number_format($accountData[$year][4572], 2),
    number_format($accountData[$year][4572] / $month * 12, 2),
    number_format($accountData[$year - 1][4572], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4580,
    'Misc',
    '?',
    number_format($accountData[$year][4580], 2),
    number_format($accountData[$year][4580] / $month * 12, 2),
    number_format($accountData[$year - 1][4580], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4571,
    'Rent',
    '?',
    number_format($accountData[$year][4571], 2),
    number_format($accountData[$year][4571] / $month * 12, 2),
    number_format($accountData[$year - 1][4571], 2),
    '100.00%'
]);

$overviewCompareList->addView('header', $overviewCompareListHeaderView);

/*
 * UI Logic
 */
$overviewTypeListView           = new \Web\Views\Lists\ListView($this->l11n);
$overviewTypeListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

$overviewTypeListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$overviewTypeListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewTypeListHeaderView->setTitle($lang['Comparison']);
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
    'Auslandskurs',
    '0.00',
    '0.00',
    '0.00',
    '0.00%',
]);

$overviewTypeListView->addView('header', $overviewTypeListHeaderView);

$tabView->addTab($lang['Overview'], $overviewCompareList->getOutput() . $overviewTypeListView->getOutput(), 'overview');

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

foreach($cars as $key => $car) {
    $sum1 = ($carData[$key][$year][4574] + $carData[$key][$year][4340] + $carData[$key][$year][4573] + $carData[$key][$year][4575] + $carData[$key][$year][4572] + $carData[$key][$year][4580]);
    $sum2 = ($carData[$key][$year - 1][4574] + $carData[$key][$year - 1][4340] + $carData[$key][$year - 1][4573] + $carData[$key][$year - 1][4575] + $carData[$key][$year - 1][4572] + $carData[$key][$year - 1][4580]);
    $sum3 = ($carData[$key][$year - 2][4574] + $carData[$key][$year - 2][4340] + $carData[$key][$year - 2][4573] + $carData[$key][$year - 2][4575] + $carData[$key][$year - 2][4572] + $carData[$key][$year - 2][4580]);

    $diff1 = ($sum2 != 0 ? ($sum1 - $sum2) / $sum2 : 'NA');
    $diff2 = ($sum3 != 0 ? ($sum2 - $sum3) / $sum3 : 'NA');

    $historyList->addElements([
        $key,
        number_format($carData[$key][$year][4574], 2),
        number_format($carData[$key][$year][4340], 2),
        number_format($carData[$key][$year][4573], 2),
        number_format($carData[$key][$year][4575], 2),
        number_format($carData[$key][$year][4572], 2),
        number_format($carData[$key][$year][4580], 2),
        number_format($sum1, 2),
        number_format($diff1 * 100, 2) . '%',
        number_format($carData[$key][$year - 1][4574], 2),
        number_format($carData[$key][$year - 1][4340], 2),
        number_format($carData[$key][$year - 1][4573], 2),
        number_format($carData[$key][$year - 1][4575], 2),
        number_format($carData[$key][$year - 1][4572], 2),
        number_format($carData[$key][$year - 1][4580], 2),
        number_format($sum2, 2),
        number_format($diff2 * 100, 2) . '%',
        number_format($carData[$key][$year - 2][4574], 2),
        number_format($carData[$key][$year - 2][4340], 2),
        number_format($carData[$key][$year - 2][4573], 2),
        number_format($carData[$key][$year - 2][4575], 2),
        number_format($carData[$key][$year - 2][4572], 2),
        number_format($carData[$key][$year - 2][4580], 2),
        number_format($sum3, 2),
    ]);
}

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
?>
<?= $tabView->getOutput(); ?>