<?php
/**
 * @var \Framework\Views\ViewAbstract $this
 */

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000701001);
?>
<?= $nav->getOutput(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->l11n->lang[7]['Settings']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <ul class="l-1">
                <li><strong><?= $this->l11n->lang[7]['Type']; ?></strong>
                <li><select>
                        <option><?= $this->l11n->lang[7]['News']; ?>
                        <option><?= $this->l11n->lang[7]['Headline']; ?>
                    </select>
                <li><strong><?= $this->l11n->lang[7]['Status']; ?></strong>
                <li><select>
                        <option><?= $this->l11n->lang[7]['Draft']; ?>
                        <option><?= $this->l11n->lang[7]['Visible']; ?>
                    </select>
                <li><strong><?= $this->l11n->lang[7]['Publish']; ?></strong>
                <li><input type="datetime-local"
                           value="<?= (new \DateTime('NOW'))->format(''); ?>">
            </ul>
            <br>
            <button><?= $this->l11n->lang[0]['Save']; ?></button>
            <button><?= $this->l11n->lang[0]['Delete']; ?></button>
        </div>
    </div>

    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->l11n->lang[7]['Permissions']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <ul>
                <li><input type="text" placeholder="<?= $this->l11n->lang[7]['Groups']; ?>">
            </ul>
        </div>
    </div>

    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->l11n->lang[7]['Additional']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <ul>
                <li><input type="checkbox"> <?= $this->l11n->lang[7]['Featured']; ?>
            </ul>
        </div>
    </div>
</div>

<div class="b-6">
    <div class="b full">
        <input type="text" class="full" placeholder="<?= $this->l11n->lang[7]['Title']; ?>">
    </div>
    <div class="tabview">
        <ul class="tab-links">
            <li class="active">
                <a href=".tab-1"><?= $this->l11n->lang[7]['Plain'] ?></a>
            <li>
                <a href=".tab-2"><?= $this->l11n->lang[7]['Preview'] ?></a>
        </ul>

        <div class="tab-content">
            <div class="tab tab-1 active">
                <div class="b full">
                    <textarea class="full" style="min-height: 200px" id="md-news"></textarea>
                </div>
            </div>
            <div class="tab tab-2">
                <div class="b full md-preview-news"></div>
            </div>
        </div>
    </div>
</div>