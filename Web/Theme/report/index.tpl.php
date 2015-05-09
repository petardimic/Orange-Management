<?php
/**
 * @var \Web\Views\Page\BackendView $this
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/top');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$top = $nav->getOutput();

$nav->setTemplate('/Modules/Navigation/Theme/backend/side');
$side = $nav->getOutput();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php
        \phpOMS\Model\Model::load_header(); ?>
        <style>
            <?php \phpOMS\Model\Model::load_style_small(); ?>
        </style>
        <script>
            var assetManager = new jsOMS.AssetManager();
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
                href="<?= \phpOMS\Uri\UriFactory::build([$this->request->getLanguage(), 'backend']); ?>"
                itemprop="legalName"><?= \phpOMS\Model\Model::$content['core:oname']; ?></a>
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
    <div id="cont" role="main">
        <?php /** @noinspection PhpUndefinedMethodInspection */
        \phpOMS\Module\ModuleFactory::$loaded['Content']->call($this->request, $this->response); ?>
    </div>
</div>
<?php \phpOMS\Model\Model::load_footer(); ?>