<?php
/**
 * @var \Framework\Views\ViewAbstract $this
 */
 
/*
 * UI Logic
 */
$groupListView = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$groupListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[1]['Groups']);
$headerView->addHeader([
	['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
	['title' => $this->l11n->lang[1]['Name'], 'sortable' => true, 'full' => true],
	['title' => $this->l11n->lang[1]['Parents'], 'sortable' => true],
	['title' => $this->l11n->lang[1]['Children'], 'sortable' => true],
	['title' => $this->l11n->lang[1]['Members'], 'sortable' => true]
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$groupListView->addView('header', $headerView);
$groupListView->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000103001);

/*
 * Template
 */
echo $nav->getResponse();
echo $groupListView->getResponse();