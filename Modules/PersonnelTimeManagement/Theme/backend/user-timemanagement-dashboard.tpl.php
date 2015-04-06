<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$timeMgmtView = new \Web\Views\Lists\ListView($this->l11n);
$headerView   = new \Web\Views\Lists\HeaderView($this->l11n);

$timeMgmtView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[35]['TimeManagement']);
$headerView->setHeader([
    ['title' => '', 'sortable' => false],
    ['title' => $this->l11n->lang[35]['Date'], 'sortable' => true],
    ['title' => $this->l11n->lang[35]['Type'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[35]['Start'], 'sortable' => true],
    ['title' => $this->l11n->lang[35]['End'], 'sortable' => true],
    ['title' => $this->l11n->lang[35]['Duration'], 'sortable' => true],
]);
$timeMgmtView->addView('header', $headerView);

/*
 * Settings
 */
/**
 * @var \phpOMS\Views\View $this
 */
$panelSettingsView = new \Web\Views\Panel\PanelView($this->l11n);
$panelSettingsView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelSettingsView->setTitle($this->l11n->lang[35]['Settings']);
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
        ['value' => 0, 'content' => $this->l11n->lang[35]['All']],
        ['value' => 1, 'content' => $this->l11n->lang[35]['Day']],
        ['value' => 2, 'content' => $this->l11n->lang[35]['Week']],
        ['value' => 3, 'content' => $this->l11n->lang[35]['Month']],
        ['value' => 4, 'content' => $this->l11n->lang[35]['Year']],
    ],
    'selected' => 3,
    'label'    => $this->l11n->lang[35]['Interval'],
    'name'     => 'interval'
]);

$this->getView('settings')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->l11n);
$panelStatView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->lang[35]['General']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->l11n);
$statTableView->setTemplate('/Web/Theme/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang[35]['Work'], '12.5 / 160 ' . $this->l11n->lang[35]['hours']],
    [$this->l11n->lang[35]['Vacation'], '20 / 28 ' . $this->l11n->lang[35]['days']],
    [$this->l11n->lang[35]['Sick'], '2 ' . $this->l11n->lang[35]['days']],
]);

$this->getView('stats')->addView('stat::table', $statTableView);
?>

<div class="b-7" id="i3-2-1">
    <?php if(($clocking = \phpOMS\Module\ModuleFactory::getInstance('Clocking')) !== null) {
        $clocking->getBackendUserClocking();
    } ?>
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <h1><?= $this->l11n->lang[35]['Planning']; ?></h1>

        <div class="bc-1">
            <button><?= $this->l11n->lang[35]['New']; ?></button>
        </div>
    </div>
    <?= $this->getView('settings')->getOutput(); ?>

    <?= $this->getView('stats')->getOutput(); ?>
</div>
<div class="b-6">
    <?= $timeMgmtView->getOutput(); ?>
</div>