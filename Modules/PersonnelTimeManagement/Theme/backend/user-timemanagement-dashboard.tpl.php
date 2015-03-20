<?php
/**
 * @var \phpOMS\Views\ViewAbstract $this
 */

/*
* UI Logic
*/
$timeListView = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$timeListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[35]['TimeManagement']);
$headerView->addHeader([
    ['title' => '', 'sortable' => false],
    ['title' => $this->l11n->lang[35]['Date'], 'sortable' => true],
    ['title' => $this->l11n->lang[35]['Type'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[35]['Start'], 'sortable' => true],
    ['title' => $this->l11n->lang[35]['End'], 'sortable' => true],
    ['title' => $this->l11n->lang[35]['Duration'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$timeListView->addView('header', $headerView);
$timeListView->addView('footer', $footerView);

/*
 * Template
 */
echo $timeListView->getOutput();