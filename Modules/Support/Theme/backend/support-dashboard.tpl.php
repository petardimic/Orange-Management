<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$supportList = new \Web\Views\Lists\ListView($this->l11n);
$headerView  = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView  = new \Web\Views\Lists\PaginationView($this->l11n);

$supportList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[29]['Support']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[29]['Status'], 'sortable' => true],
    ['title' => $this->l11n->lang[29]['Priority'], 'sortable' => true],
    ['title' => $this->l11n->lang[29]['Title'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[29]['Account'], 'sortable' => true],
    ['title' => $this->l11n->lang[29]['Creator'], 'sortable' => true],
    ['title' => $this->l11n->lang[29]['Created'], 'sortable' => true],
    ['title' => $this->l11n->lang[29]['Receiver'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$supportList->addView('header', $headerView);
$supportList->addView('footer', $footerView);

/*
 * Settings
 */
/**
 * @var \phpOMS\Views\View $this
 */
$panelSettingsView = new \Web\Views\Panel\PanelView($this->l11n);
$panelSettingsView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelSettingsView->setTitle($this->l11n->lang[29]['Settings']);
$this->addView('settings', $panelSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->l11n);
$settingsFormView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$settingsFormView->setHasSubmit(false);
$settingsFormView->setOnChange(true);
$settingsFormView->setAction('http://127.0.0.1');
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang[29]['All']],
        ['value' => 1, 'content' => $this->l11n->lang[29]['Day']],
        ['value' => 2, 'content' => $this->l11n->lang[29]['Week']],
        ['value' => 3, 'content' => $this->l11n->lang[29]['Month']],
        ['value' => 4, 'content' => $this->l11n->lang[29]['Year']],
    ],
    'selected' => 3,
    'label'    => $this->l11n->lang[29]['Interval'],
    'name'     => 'interval'
]);

$this->getView('settings')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->l11n);
$panelStatView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->lang[29]['Statistics']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->l11n);
$statTableView->setTemplate('/Web/Theme/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang[29]['Received'], 0],
    [$this->l11n->lang[29]['Created'], 0],
    [$this->l11n->lang[29]['Forwarded'], 0],
    [$this->l11n->lang[29]['AverageAmount'], 0],
    [$this->l11n->lang[29]['AverageProcessTime'], 0],
    [$this->l11n->lang[29]['InTime'], 0],
]);

$this->getView('stats')->addView('stat::table', $statTableView);
?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <button><?= $this->l11n->lang[29]['New']; ?></button>
        </div>
    </div>
    <?= $this->getView('settings')->getOutput(); ?>

    <?= $this->getView('stats')->getOutput(); ?>
</div>
<div class="b-6">
    <?= $supportList->getOutput(); ?>
</div>