<?php

/**
 * @var \phpOMS\Views\View $this
 */

include_once __DIR__ . '/../../Templates/' . $this->getData('name') . '/' . $this->getData('name') . '.lang.php';

$this->getView('DataView')->addData('lang', $reportLanguage[$this->l11n->getLanguage()]);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);
?>
<?= $nav->render(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><a href="<?= \phpOMS\Uri\UriFactory::build([$this->l11n->getLanguage(), 'backend', 'reporter', 'edit'], ['id' => $this->getData('name')]); ?>" class="button"><?= $this->l11n->lang[27]['Edit']; ?></a>
            </ul>
        </div>
    </div>

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
                        <!-- TODO: select language based on user language if language exists! -->
                        <?php foreach ($reportLanguage as $key => $language): ?>
                        <option value="<?= $key; ?>"><?= $language[':language']; ?>
                            <?php endforeach; ?>
                    </select>
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
    <?= $this->getView('DataView')->render(); ?>
</div>