<?php
/**
 * @var \phpOMS\Views\ViewAbstract $this
 */

/*
* UI Logic
*/
$unitList = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$unitList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[30]['Units']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[30]['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[30]['Parent'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$unitList->addView('header', $headerView);
$unitList->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1003001001);
?>
<?= $nav->getOutput(); ?>

<div class="b-7" id="i3-2-1">

</div>
<div class="b-6">
    <?= $unitList->getOutput(); ?>
</div>