<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$timeMgmtView = new \Web\Views\Lists\ListView($this->l11n, $this->response, $this->request);
$headerView   = new \Web\Views\Lists\HeaderView($this->l11n, $this->response, $this->request);

$timeMgmtView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[35]['TimeManagement']);
$headerView->setHeader([
    ['title' => '', 'sortable' => false],
    ['title' => $this->l11n->lang[35]['Date'], 'sortable' => true],
    ['title' => $this->l11n->lang[35]['Status'], 'sortable' => true],
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
$panelSettingsView = new \Web\Views\Panel\PanelView($this->l11n, $this->response, $this->request);
$panelSettingsView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelSettingsView->setTitle($this->l11n->lang[35]['Settings']);
$this->addView('settings', $panelSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->l11n, $this->response, $this->request);
$settingsFormView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$settingsFormView->setHasSubmit(false);
$settingsFormView->setOnChange(true);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        ['value' => 0, 'content' => $this->l11n->lang[35]['All']],
        ['value' => 1, 'content' => $this->l11n->lang[35]['Day']],
        ['value' => 2, 'content' => $this->l11n->lang[35]['Week']],
        ['value' => 3, 'content' => $this->l11n->lang[35]['Month'], 'selected' => true],
        ['value' => 4, 'content' => $this->l11n->lang[35]['Year']],
    ],
    'label'   => $this->l11n->lang[35]['Interval'],
    'name'    => 'interval'
]);

$this->getView('settings')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->l11n, $this->response, $this->request);
$panelStatView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->lang[35]['General']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->l11n, $this->response, $this->request);
$statTableView->setTemplate('/Web/Theme/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang[35]['Surplus'], '-2.4 hours'],
    [$this->l11n->lang[35]['Working'], '136 hours'],
    [$this->l11n->lang[35]['Late'], '3'],
    [$this->l11n->lang[35]['Vacation'], '5'],
    [$this->l11n->lang[35]['Sick'], '1'],
    [$this->l11n->lang[35]['Travel'], '17'],
    [$this->l11n->lang[35]['Remote'], '2'],
    [$this->l11n->lang[35]['Other'], '0'],
]);

$this->getView('stats')->addView('stat::table', $statTableView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1003501001);
?>
<?= $nav->render(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <h1><?= $this->l11n->lang[35]['Planning']; ?></h1>

        <div class="bc-1">
            <button><?= $this->l11n->lang[35]['New']; ?></button>
        </div>
    </div>
    <?= $this->getView('settings')->render(); ?>

    <?= $this->getView('stats')->render(); ?>
</div>
<div class="b-6">
    <?= $timeMgmtView->render(); ?>
</div>