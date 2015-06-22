<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$reporterListView = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$headerView       = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);
$footerView       = new \Web\Views\Lists\PaginationView($this->l11n, $this->request, $this->response);

$reporterListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

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
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);

/*
 * Template
 */
echo $nav->render();
echo $reporterListView->render();