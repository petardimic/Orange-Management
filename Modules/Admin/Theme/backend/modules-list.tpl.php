<?php
/**
 * @var \Framework\Views\ViewAbstract $this
 */

/*
 * UI Logic
 */
$moduleListView = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$moduleListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[1]['Modules']);
$headerView->addHeader([
    ['title' => $this->l11n->lang[1]['Status'], 'sortable' => true],
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[1]['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[1]['Theme'], 'sortable' => true]
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$moduleListView->addView('header', $headerView);
$moduleListView->addView('footer', $footerView);

/*
 * Template
 */
echo $moduleListView->getResponse();