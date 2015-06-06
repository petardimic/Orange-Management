<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
* UI Logic
*/
$mainTableView = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$headerView    = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);
$footerView    = new \Web\Views\Lists\PaginationView($this->l11n, $this->request, $this->response);

$mainTableView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[30]['Risks']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[30]['Parent'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Severity'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Probability'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Department'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Category'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Project'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Process'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Manager'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Due'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$mainTableView->addView('header', $headerView);
$mainTableView->addView('footer', $footerView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$panelStatView->setTemplate('/Web/Theme/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->lang[30]['Statistics']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$statTableView->setTemplate('/Web/Theme/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang[30]['AvgRiskAmount'], 0],
]);

$this->getView('stats')->addView('stat::table', $statTableView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1003001001);
?>
<?= $nav->render(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <button><?= $this->l11n->lang[30]['New']; ?></button>
        </div>
    </div>

    <?= $panelStatView->render(); ?>
</div>
<div class="b-6">
    <?= $mainTableView->render(); ?>
</div>