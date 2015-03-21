<?php
/**
* @var \phpOMS\Views\ViewAbstract $this
*/

/*
* UI Logic
*/
$newsListview = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$newsListview->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[7]['Archive']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[7]['Type'], 'sortable' => true],
    ['title' => $this->l11n->lang[7]['Title'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[7]['Author'], 'sortable' => true],
    ['title' => $this->l11n->lang[7]['Date'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$newsListview->addView('header', $headerView);
$newsListview->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000701001);

/*
 * Template
 */
echo $nav->getOutput();
echo $newsListview->getOutput();