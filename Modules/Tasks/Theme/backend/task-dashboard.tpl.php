<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$tasksList  = new \Web\Views\Lists\ListView($this->l11n, $this->response, $this->request);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n, $this->response, $this->request);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n, $this->response, $this->request);

$tasksList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[11]['Tasks']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Status'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Priority'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Title'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[11]['Creator'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Created'], 'sortable' => true]
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$tasksList->addView('header', $headerView);
$tasksList->addView('footer', $footerView);

/*
 * Settings
 */
/**
 * @var \phpOMS\Views\View $this
 */
$panelSettingsView = new \Web\Views\Panel\PanelView($this->l11n, $this->response, $this->request);
$panelSettingsView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelSettingsView->setTitle($this->l11n->lang[11]['Settings']);
$this->addView('settings', $panelSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->l11n, $this->response, $this->request);
$settingsFormView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$settingsFormView->setHasSubmit(false);
$settingsFormView->setOnChange(true);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang[11]['All']],
        ['value' => 1, 'content' => $this->l11n->lang[11]['Day']],
        ['value' => 2, 'content' => $this->l11n->lang[11]['Week']],
        ['value' => 3, 'content' => $this->l11n->lang[11]['Month']],
        ['value' => 4, 'content' => $this->l11n->lang[11]['Year']],
    ],
    'selected' => 3,
    'label'    => $this->l11n->lang[11]['Interval'],
    'name'     => 'interval'
]);

$this->getView('settings')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->l11n, $this->response, $this->request);
$panelStatView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->lang[11]['Statistics']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->l11n, $this->response, $this->request);
$statTableView->setTemplate('/Web/Theme/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang[11]['Received'], 0],
    [$this->l11n->lang[11]['Created'], 0],
    [$this->l11n->lang[11]['Forwarded'], 0],
    [$this->l11n->lang[11]['AverageAmount'], 0],
    [$this->l11n->lang[11]['AverageProcessTime'], 0],
    [$this->l11n->lang[11]['InTime'], 0],
]);

$this->getView('stats')->addView('stat::table', $statTableView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1001101001);
?>
<?= $nav->getOutput(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <a href="create.php" class="button"><?= $this->l11n->lang[11]['New']; ?></a>
        </div>
    </div>
    <?= $this->getView('settings')->getOutput(); ?>

    <?= $this->getView('stats')->getOutput(); ?>
</div>
<div class="b-6">
    <?= $tasksList->getOutput(); ?>
</div>