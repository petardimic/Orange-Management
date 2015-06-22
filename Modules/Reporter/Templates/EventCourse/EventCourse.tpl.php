<?php
/**
 * @var \phpOMS\Views\View $this
 */

$tabView = new \Web\Views\Divider\TabularView($this->l11n, $this->request, $this->response);
$tabView->setTemplate('/Web/Templates/Divider/Tabular');
$lang = $this->getData('lang');

$year  = 2015;
$month = 3;

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
    number_format(0.00, 2),
    number_format(0.00 / $month * 12, 2),
    number_format(0.00, 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    'EventCourse',
    '?',
    number_format(0.00, 2),
    number_format(0.00, 2),
    number_format(0.00, 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    'Demo',
    '?',
    number_format(0.00, 2),
    number_format(0.00, 2),
    number_format(0.00, 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    'Briefing',
    '?',
    number_format(0.00, 2),
    number_format(0.00, 2),
    number_format(0.00, 2),
    '100.00%'
]);

$overviewCompareList->addElements([
    'Advice',
    '?',
    number_format(0.00, 2),
    number_format(0.00, 2),
    number_format(0.00, 2),
    '100.00%'
]);

$overviewCompareList->addView('header', $overviewCompareListHeaderView);

/*
 * UI Logic
 */
/* TODO: Costs/Success for all */
$overviewTypeListView           = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$overviewTypeListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

$overviewTypeListView->setTemplate('/Web/Templates/Lists/ListFull');
$overviewTypeListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

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
$overviewCostCenterView           = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$overviewCostCenterHeaderView = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

$overviewCostCenterView->setTemplate('/Web/Templates/Lists/ListFull');
$overviewCostCenterHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

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
$overviewAccountView           = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$overviewAccountHeaderView = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

$overviewAccountView->setTemplate('/Web/Templates/Lists/ListFull');
$overviewAccountHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

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

$graphProgressView = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$graphProgressView->setTemplate('/Web/Templates/Panel/BoxFull');
$graphProgressView->setTitle($lang['Progress']);

$tabView->addTab($lang['Overview'], $overviewCompareList->getOutput() . $overviewTypeListView->render() . $overviewCostCenterView->render() . $overviewAccountView->render() . $graphProgressView->render(), 'overview');

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
$carsListHeaderView->setTitle();
$carsListHeaderView->setHeader([
    ['title' => $lang['ID'], 'sortable' => true],
]);

$carsList->setFreeze(1, 0);
$carsList->addView('header', $carsListHeaderView);

$tabView->addTab($lang['CostObject'], $carsList->getOutput(), 'cars');

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
]);

$historyList->setFreeze(1, 1);
$historyList->addView('header', $historyListHeaderView);

$tabView->addTab($lang['CostCenter'], $historyList->getOutput(), 'history');

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
]);

$planningList->setFreeze(3, 2);
$planningList->addView('header', $planningListHeaderView);
$tabView->addTab($lang['Account'], $planningList->getOutput(), 'planning');
?>
<?= $tabView->render(); ?>