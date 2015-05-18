<?php
/**
 * @var \phpOMS\Views\View $this
 */
/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000701001);
?>
<?= $nav->render(); ?>

<div class="b-2 c7-2 c7 lf" id="i7-2-1">
    <table class="t t-1 c4-1 c4" id="i4-1-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <h1><?= $this->l11n->lang[7]['News'] ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
                <tr>
                    <th><?= $this->l11n->lang[7]['Type']; ?>
                    <th class="full lT"><?= $this->l11n->lang[7]['Title']; ?>
                    <th><?= $this->l11n->lang[7]['Author']; ?>
                    <th><?= $this->l11n->lang[7]['Date']; ?>
        <tbody>
    </table>
</div>

<div class="b-2 c7-2 c7 lf" id="i7-2-2">
    <table class="t t-1 c4-1 c4" id="i4-1-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <h1><?= $this->l11n->lang[7]['Headlines'] ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>

                <tr>
                    <th><?= $this->l11n->lang[7]['Type']; ?>
                    <th class="full lT"><?= $this->l11n->lang[7]['Title']; ?>
                    <th><?= $this->l11n->lang[7]['Author']; ?>
                    <th><?= $this->l11n->lang[7]['Date']; ?>
        <tbody>
    </table>
</div>