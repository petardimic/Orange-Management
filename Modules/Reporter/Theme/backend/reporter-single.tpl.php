<?php
/**
 * @var \phpOMS\Views\ViewAbstract $this
 */
/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);
?>
<?= $nav->getOutput(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><?= $this->l11n->lang[27]['Dataset']; ?>
                <li><select>
                        <option value="0" selected>
                    </select>
            </ul>
        </div>
    </div>

    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><select>
                        <option value="0" selected>PDF
                        <option value="1">Excel
                        <option value="2">CSV
                        <option value="2">JSON
                    </select>
                <li>
                    <button><?= $this->l11n->lang[27]['Export']; ?></button
            </ul>
        </div>
    </div>

    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <h1><?= $this->l11n->lang[27]['Info']; ?></h1>

        <div class="bc-1">
            <!-- @formatter:off -->
            <table class="tc-1">
                <tr>
                    <th><label><?= $this->l11n->lang[27]['Creator']; ?></label>
                    <td>asldkf
                <tr>
                    <th><label><?= $this->l11n->lang[27]['Created']; ?></label>
                    <td>asldkf
                <tr>
                    <th><label><?= $this->l11n->lang[27]['Datasets']; ?></label>
                    <td>asldkf
            </table>
            <!-- @formatter:on -->
        </div>
    </div>
</div>
<div class="b-6">
    <?= $this->getView('DataView')->getOutput(); ?>
</div>