<?php
/**
 * @var \Web\Views\Page\GenericView $this
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/backend/top');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$top = $nav->render();

$nav->setTemplate('/Modules/Navigation/Theme/backend/side');
$side = $nav->render();
$head = $this->response->getHead();
?>
<!DOCTYPE HTML>
<html>
<head>
    <?= $head->getMeta()->render(); ?>
    <title><?= $a = $head->getTitle(); ?></title>
    <?= $head->renderAssets(); ?>
    <style>
        <?= $head->renderStyle(); ?>
    </style>
    <script>
        <?= $head->renderScript(); ?>
    </script>
</head>
<body>
<div class="vh" id="dim"></div>
<div id="h">
    <div id="bar-s">
        <?= $top; ?>
    </div>
    <div id="bar-b">
        <span class="vC" id="nav-toggle">
            <i class="fa fa-bars ani-click" data-aniref="#s-nav" data-aniin="slide-right" data-aniout="slide-left"
               data-anistate="1" data-anitime="300"></i>
        </span>
        <span class="vC" id="logo" itemscope itemtype="http://schema.org/Organization"><a
                href="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/backend.php'); ?>"
                itemprop="legalName"><?= $this->getData('Name') ?></a>
        </span>
        <span class="vC" id="s-bar" role="search">
            <label> <input type="text" autofocus="autofocus"> </label>
            <input type="submit" value="<?= $this->l11n->lang[0]['Search'] ?>">
        </span>
        <span class="vC" id="u-box">
            <img class="rf" src="<?= '/Web/Theme/backend/img/default-user.jpg'; ?>">
        </span>

        <div id="u-logo" itemscope itemtype="http://schema.org/Person"></div>
    </div>
</div>
<div id="out">
    <?= $side; ?>
    <div id="cont" role="main">
        <?= $this->app->moduleManager->get('Content')->call($this->request, $this->response); ?>
    </div>
</div>
