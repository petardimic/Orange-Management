<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000401001);
?>
<?= $nav->render(); ?>
<div class="b b-5 c4-2 c4" id="i4-2-1">
    <h1>
        <?= $this->l11n->lang[4]['Upload']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <div style="min-height: 150px">
            Drag or click here for upload!
        </div>
        <button class="rf"><?= $this->l11n->lang[0]['Submit']; ?></button>
        <div class="clearfix"></div>
    </div>
</div>