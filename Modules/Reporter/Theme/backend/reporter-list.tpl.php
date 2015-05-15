<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$reporterListView = new \Web\Views\Lists\ListView($this->l11n, $this->response, $this->request);
$headerView       = new \Web\Views\Lists\HeaderView($this->l11n, $this->response, $this->request);
$footerView       = new \Web\Views\Lists\PaginationView($this->l11n, $this->response, $this->request);

$reporterListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[27]['Reporter']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[27]['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[27]['Creator'], 'sortable' => true],
    ['title' => $this->l11n->lang[27]['Created'], 'sortable' => true]
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$reporterListView->addView('header', $headerView);
$reporterListView->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);

/*
 * Template
 */
echo $nav->getOutput();
echo $reporterListView->getOutput();