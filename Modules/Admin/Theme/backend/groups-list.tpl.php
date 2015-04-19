<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$groupListView = new \Web\Views\Lists\ListView($this->l11n);
$headerView    = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView    = new \Web\Views\Lists\PaginationView($this->l11n);

$groupListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

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
    $url = \phpOMS\Uri\UriFactory::build([$this->l11n->getLanguage(),
                                          'backend',
                                          'admin',
                                          'group',
                                          'single',
                                          'front'], ['id' => $value['group_id']]);
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
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000103001);

/*
 * Template
 */
echo $nav->getOutput();
echo $groupListView->getOutput();