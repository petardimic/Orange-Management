<?php
/*
 * UI Logic
 */

/**
 * @var \Framework\Views\ViewAbstract $this
 */
$groupListView = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$groupListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

$headerView->setTitle('Test');
$headerView->addHeader([['title' => 'Title 1', 'sortable' => true]]);

$groupListView->addView('header', $headerView);
$groupListView->addView('footer', $footerView);

/*
 * Template
 */
echo $groupListView->getResponse();