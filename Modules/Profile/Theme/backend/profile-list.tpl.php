<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
* UI Logic
*/
$profileList = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$headerView  = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);
$footerView  = new \Web\Views\Lists\PaginationView($this->l11n, $this->request, $this->response);

$profileList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[3]['Profiles']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[3]['Activity'], 'sortable' => true],
    ['title' => $this->l11n->lang[3]['Name'], 'sortable' => true, 'full' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$profileList->addView('header', $headerView);
$profileList->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000301001);
?>

<?= $nav->render(); ?>
<?= $profileList->render();