<!DOCTYPE HTML>
<html>
<head>
    <?php /** @var \Content\Theme $this */
    \Framework\Model\Model::load_header(); ?>
    <style>
        <?php \Framework\Model\Model::load_style_small(); ?>
    </style>
</head>
<body>
<div class="vh" id="dim"></div>
<?php \Framework\Module\ModuleFactory::$loaded['GlobalContent']->callWeb(); ?>
<div id="h">
    <div id="bar-s">
        <?php \Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::TOP]); ?>
    </div>
    <div id="bar-b">
        <span class="vC" id="nav-toggle">
            <i class="fa fa-bars ani-click" data-aniref="#s-nav" data-aniin="slide-right" data-aniout="slide-left"
               data-anistate="1" data-anitime="300"></i>
        </span>
        <span class="vC" id="logo" itemscope itemtype="http://schema.org/Organization"><a
                href="<?= \Framework\Uri\UriFactory::build([$this->app->request->lang, 'backend']); ?>"
                itemprop="legalName"><?= \Framework\Model\Model::$content['core:oname']; ?></a>
        </span>
        <span class="vC" id="s-bar" role="search">
            <label>
                <input type="text" autofocus="autofocus">
            </label>
            <input type="submit" value="<?= $this->app->user->localization->lang[0]['Search'] ?>">
        </span>

        <div id="u-logo" itemscope itemtype="http://schema.org/Person"></div>
    </div>
</div>
<div id="out">
    <?php \Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::SIDE]); ?>
    <div id="cont" role="main">
        <?php \Framework\Module\ModuleFactory::$loaded['Content']->callWeb(); ?>
    </div>
</div>
<?php \Framework\Model\Model::load_footer(); ?>