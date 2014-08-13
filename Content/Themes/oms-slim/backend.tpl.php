<!DOCTYPE HTML>
<html>
<head>
    <?php /** @var \Framework\Controller\Controller $this */
    \Framework\Model\Model::load_header(); ?>
    <style>
        <?php \Framework\Model\Model::load_style_small(); ?>
    </style>
</head>
<body>
<div class="vh" id="dim"></div>
<?php $this->modules->running[1004300000]->show(); ?>
<div id="h">
    <div id="bar-s">
        <?php $this->modules->running[1000500000]->show([1]); ?>
    </div>
    <div id="bar-b">
        <span class="vC" id="nav-toggle">
            <i class="fa fa-bars ani-click" data-aniref="#s-nav" data-aniin="slide-right" data-aniout="slide-left" data-anistate="1" data-anitime="300"></i>
        </span>
        <span class="vC" id="logo"><a
                href="<?= $this->request->generate_uri([$this->request->request_lang, 'backend']); ?>"><?= \Framework\Model\Model::$content['core:oname']; ?></a>
        </span>
        <span class="vC" id="s-bar">
            <label>
                <input type="text">
            </label>
            <input type="submit" value="<?= \Framework\Localization\Localization::$lang[0]['Search'] ?>">
        </span>
        <div id="u-logo"></div>
    </div>
</div>
<div id="out">
    <?php $this->modules->running[1000500000]->show([2]); ?>
    <div id="cont">
        <?php $this->modules->running[1004100000]->show(); ?>
    </div>
</div>
<?php \Framework\Model\Model::load_footer(); ?>
</body>
</html>