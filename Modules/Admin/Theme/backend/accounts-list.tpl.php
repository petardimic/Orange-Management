<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$accountListView = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$headerView      = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);
$footerView      = new \Web\Views\Lists\PaginationView($this->l11n, $this->request, $this->response);

$accountListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[1]['Accounts']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[1]['Status'], 'sortable' => true],
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[1]['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[1]['Activity'], 'sortable' => true],
    ['title' => $this->l11n->lang[1]['Created'], 'sortable' => true]
]);

foreach($this->getData('list:elements') as $key => $value) {
    $url = \phpOMS\Uri\UriFactory::build('/{/lang}/Backend/admin/account/single/front.php?id=' . (int)$value['account_id']);

    $accountListView->addElements([
        '<a href="' . $url . '">' . $value['account_status'] . '</a>',
        '<a href="' . $url . '">' . $value['account_id'] . '</a>',
        '<a href="' . $url . '">' . $value['account_data_name1'] . '</a>',
        '<a href="' . $url . '">' . $value['account_lactive'] . '</a>',
        '<a href="' . $url . '">' . $value['account_created'] . '</a>',
    ]);
}

/*
 * Footer
 */
$footerView->setPages($this->getData('list:count') / 25);
$footerView->setPage(1);
$footerView->setResults($this->getData('list:count'));

$accountListView->addView('header', $headerView);
$accountListView->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000104001);

/*
 * Template
 */
echo $nav->render();
echo $accountListView->render();