<?php
/**
 * @var \phpOMS\Views\ViewAbstract $this
 */

/*
* UI Logic
*/
$profileList = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$profileList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[3]['Profiles']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[1]['Activity'], 'sortable' => true],
    ['title' => $this->l11n->lang[1]['Name'], 'sortable' => true, 'full' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$profileList->addView('header', $headerView);
$profileList->addView('footer', $footerView);

/*
 * Template
 */
echo $profileList->getOutput();