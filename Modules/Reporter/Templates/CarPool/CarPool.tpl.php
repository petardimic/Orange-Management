<?php
/**
 * @var \phpOMS\Views\View $this
 */

$tabView = new \Web\Views\Divider\TabularView($this->l11n, $this->request, $this->response);
$tabView->setTemplate('/Web/Templates/Divider/Tabular');
$lang = $this->getData('lang');

// $csv = json_decode(file_get_contents(__DIR__ . '/NOGIT.json', true)); = faster but addional modification to json
$file = fopen(__DIR__ . '/NOGITCARS.csv', 'r');

$cars = [];
while(($line = fgetcsv($file, 0, ';')) !== false) {
    $line[2]        = number_format((float) str_replace(':', ',', str_replace(',', '.', str_replace('.', ':', $line[2]))), 2);
    $line[3]        = number_format((float) str_replace(':', ',', str_replace(',', '.', str_replace('.', ':', $line[3]))), 2);
    $line[4]        = number_format((float) str_replace(':', ',', str_replace(',', '.', str_replace('.', ':', $line[4]))), 2);
    $line[5]        = number_format((float) str_replace(':', ',', str_replace(',', '.', str_replace('.', ':', $line[5]))), 2);
    $line[6]        = number_format((float) str_replace(':', ',', str_replace(',', '.', str_replace('.', ':', $line[6]))), 2);
    $cars[$line[0]] = $line;
}
fclose($file);

$file = fopen(__DIR__ . '/NOGIT.csv', 'r');

//$bookentries = [];
$carData     = [];
$accountData = [];
while(($line = fgetcsv($file)) !== false) {
    //$bookentries[] = $line;

    if(array_key_exists($line[9], $cars) || $line[9] === '') {
        if($line[9] === '') {
            $line[9] = 'EMPTY';
        }

        $soll  = (float) str_replace(':', ',', str_replace(',', '.', str_replace('.', ':', $line[3])));
        $haben = (float) str_replace(':', ',', str_replace(',', '.', str_replace('.', ':', $line[4])));
        $tYear = (int) ((new DateTime($line[0]))->format('Y'));

        if(!isset($carData[$line[9]][$tYear][(int) $line[10]])) {
            $carData[$line[9]][$tYear][(int) $line[10]] = 0;
        }

        if(!isset($accountData[$tYear][(int) $line[10]])) {
            $accountData[$tYear][(int) $line[10]] = 0;
        }

        $carData[$line[9]][$tYear][(int) $line[10]] += $soll;
        $carData[$line[9]][$tYear][(int) $line[10]] -= $haben;
        $accountData[$tYear][(int) $line[10]] += (float) $soll;
        $accountData[$tYear][(int) $line[10]] -= (float) $haben;
    }
}
fclose($file);

$year  = 2015;
$month = 3;

$accounts = [4574, 4340, 4573, 4575, 4572, 4580];

for($y = $year; $y > $year-3; $y--) {
    foreach($accounts as $account) {
        if(!isset($accountData[$y][$account])) {
            $accountData[$y][$account] = 0;
        }

        foreach($cars as $car => $more) {
            if(!isset($carData[$car][$y][$account])) {
                $carData[$car][$y][$account] = 0;
            }
        }

    }
}


/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);
?>

<?= $nav->render(); ?>

<?php
/*
 * UI Logic
 */
$overviewCompareList           = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$overviewCompareListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

$overviewCompareList->setTemplate('/Web/Templates/Lists/ListFull');
$overviewCompareListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewCompareListHeaderView->setTitle($lang['Comparison']);
$overviewCompareListHeaderView->setHeader([
    ['title' => $lang['Account'], 'sortable' => true],
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
    $lang['Leasing'],
    '?',
    number_format($accountData[$year][4574], 2),
    number_format($accountData[$year][4574] / $month * 12, 2),
    number_format($accountData[$year - 1][4574], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4340,
    $lang['Tax'],
    '?',
    number_format($accountData[$year][4340], 2),
    number_format($accountData[$year][4340] / $month * 12, 2),
    number_format($accountData[$year - 1][4340], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4573,
    $lang['Rep./Insp.'],
    '?',
    number_format($accountData[$year][4573], 2),
    number_format($accountData[$year][4573] / $month * 12, 2),
    number_format($accountData[$year - 1][4573], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4575,
    $lang['Wheels'],
    '?',
    number_format($accountData[$year][4575], 2),
    number_format($accountData[$year][4575] / $month * 12, 2),
    number_format($accountData[$year - 1][4575], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4572,
    $lang['Gas'],
    '?',
    number_format($accountData[$year][4572], 2),
    number_format($accountData[$year][4572] / $month * 12, 2),
    number_format($accountData[$year - 1][4572], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4580,
    $lang['Misc'],
    '?',
    number_format($accountData[$year][4580], 2),
    number_format($accountData[$year][4580] / $month * 12, 2),
    number_format($accountData[$year - 1][4580], 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    4571,
    $lang['Rent'],
    '?',
    number_format($accountData[$year][4571], 2),
    number_format($accountData[$year][4571] / $month * 12, 2),
    number_format($accountData[$year - 1][4571], 2),
    '100.00%'
]);

$overviewCompareList->addView('header', $overviewCompareListHeaderView);

$graphProgressView = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$graphProgressView->setTemplate('/Web/Templates/Panel/BoxHalf');
$graphProgressView->setTitle($lang['Progress']);

$graphComparisonView = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$graphComparisonView->setTemplate('/Web/Templates/Panel/BoxHalf');
$graphComparisonView->setTitle($lang['Comparison']);

$tabView->addTab($lang['Overview'], $overviewCompareList->getOutput() . $graphProgressView->render() . $graphComparisonView->render(), 'overview');

/*
 * UI Logic
 */
$carsList           = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$carsListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

$carsList->setTemplate('/Web/Templates/Lists/ListFull');
$carsListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

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

$tabView->addTab($lang['Cars'], $carsList->getOutput(), 'cars');

/*
 * UI Logic
 */
$historyList           = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$historyListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

$historyList->setTemplate('/Web/Templates/Lists/ListFull');
$historyListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

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

$tabView->addTab($lang['History'], $historyList->getOutput(), 'history');

/*
 * UI Logic
 */
$planningList           = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$planningListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

$planningList->setTemplate('/Web/Templates/Lists/ListFull');
$planningListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

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
$tabView->addTab($lang['Planning'], $planningList->getOutput(), 'planning');
?>
<?= $tabView->render(); ?>