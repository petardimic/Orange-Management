<!DOCTYPE HTML>
<html>
<head>
    <?php /** @var \Web\Views\Page\BackendView $this */
    \Framework\Model\Model::load_header(); ?>
    <style>
        <?php \Framework\Model\Model::load_style_small(); ?>
    </style>
</head>
<body>
<div class="vh" id="dim"></div>
<?php /** @noinspection PhpUndefinedMethodInspection */
// TODO: use content module with paramenter in order to call global content
//\Framework\Module\ModuleFactory::$loaded['GlobalContent']->call(\Framework\Module\CallType::WEB); ?>
<div id="h">
    <div id="bar-s">
        <?php /** @noinspection PhpUndefinedMethodInspection */
        \Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, $this->request, [\Modules\Navigation\Models\NavigationType::TOP]); ?>
    </div>
    <div id="bar-b">
        <span class="vC" id="nav-toggle">
            <i class="fa fa-bars ani-click" data-aniref="#s-nav" data-aniin="slide-right" data-aniout="slide-left"
               data-anistate="1" data-anitime="300"></i>
        </span>
        <span class="vC" id="logo" itemscope itemtype="http://schema.org/Organization"><a
                href="<?= \Framework\Uri\UriFactory::build([$this->request->getLanguage(), 'backend']); ?>"
                itemprop="legalName"><?= \Framework\Model\Model::$content['core:oname']; ?></a>
        </span>
        <span class="vC" id="s-bar" role="search">
            <label> <input type="text" autofocus="autofocus"> </label>
            <input type="submit" value="<?= $this->l11n->lang[0]['Search'] ?>">
        </span>

        <div id="u-logo" itemscope itemtype="http://schema.org/Person"></div>
    </div>
</div>
<div id="out">
    <?php /** @noinspection PhpUndefinedMethodInspection */
    \Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, $this->request, [\Modules\Navigation\Models\NavigationType::SIDE]); ?>
    <div id="cont" role="main">
        <?php /** @noinspection PhpUndefinedMethodInspection */
        \Framework\Module\ModuleFactory::$loaded['Content']->call(\Framework\Module\CallType::WEB, $this->request); ?>
    </div>
</div>
<?php \Framework\Model\Model::load_footer(); ?>