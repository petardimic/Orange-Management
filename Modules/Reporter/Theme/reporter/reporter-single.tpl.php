<?php

/**
 * @var \phpOMS\Views\View $this
 */
include_once __DIR__ . '/../../Templates/' . $this->getData('name') . '/' . $this->getData('name') . '.lang.php';

$this->getView('DataView')->addData('lang', $reportLanguage[$this->l11n->getLanguage()]);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002710000);
?>
<?= $nav->render(); ?>

<div class="b-5">
    <?= $this->getView('DataView')->render(); ?>
</div>