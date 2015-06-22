<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$groupListView = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$headerView    = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);
$footerView    = new \Web\Views\Lists\PaginationView($this->l11n, $this->request, $this->response);

$groupListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[1]['Groups']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[1]['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[1]['Parents'], 'sortable' => true],
    ['title' => $this->l11n->lang[1]['Children'], 'sortable' => true],
    ['title' => $this->l11n->lang[1]['Members'], 'sortable' => true]
]);

foreach($this->getData('list:elements') as $key => $value) {
    $url = \phpOMS\Uri\UriFactory::build('/{/lang}/Backend/admin/group/single/front.php?id=' . $value['group_id']);
    $groupListView->addElements([
        '<a href="' . $url . '">' . $value['group_id'] . '</a>',
        '<a href="' . $url . '">' . $value['group_name'] . '</a>',
        null,
        null,
        null
    ]);
}

/*
 * Footer
 */
$footerView->setPages($this->getData('list:count') / 25);
$footerView->setPage(1);
$footerView->setResults($this->getData('list:count'));

$groupListView->addView('header', $headerView);
$groupListView->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000103001);

/*
 * Template
 */
echo $nav->render();
echo $groupListView->render();