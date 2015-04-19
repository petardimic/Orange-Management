<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$unitListView = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$unitListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[47]['Units']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[47]['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[47]['Parent'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages($this->getData('list:count')/25);
$footerView->setPage(1);
$footerView->setResults($this->getData('list:count'));

$unitListView->addView('header', $headerView);
$unitListView->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1004702001);

/*
 * Template
 */
echo $nav->getOutput();
echo $unitListView->getOutput();