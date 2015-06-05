<?php

/**
 * @var \phpOMS\Views\View $this
 */

include_once __DIR__ . '/../../Templates/' . $this->getData('name') . '/' . $this->getData('name') . '.lang.php';

$this->getView('DataView')->addData('lang', $reportLanguage[$this->l11n->getLanguage()]);

$formExport = new \Web\Views\Form\FormView($this->l11n, $this->response, $this->request);
$formExport->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formExport->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formExport->setMethod(\phpOMS\Message\RequestMethod::POST);

$formExport->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 'en', 'content' => 'English'],
    ],
    'selected' => 'en',
    'label'    => $this->l11n->lang[27]['Language'],
    'name'     => 'lang'
]);

$formExport->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 'pdf', 'content' => 'PDF'],
        ['value' => 'csv', 'content' => 'CSV'],
        ['value' => 'json', 'content' => 'JSON'],
        ['value' => 'xlsx', 'content' => 'Excel'],
    ],
    'selected' => '',
    'label'    => $this->l11n->lang[27]['Type'],
    'name'     => 'type'
]);

$formExport->setElement(2, 0, [
    'type'  => \phpOMS\Html\TagType::BUTTON,
    'label' => $this->l11n->lang[27]['Export'],
    'name'  => 'export',
    'data'  => [
        'ropen' => '/{#lang}/raw/reporter/export.php?id={?id}&type={#type}'
    ]
]);

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
                <li>
                    <a href="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/backend/reporter/edit.php?id=' . $this->getData('name')); ?>"
                       class="button"><?= $this->l11n->lang[27]['Edit']; ?></a>
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
            <?= $formExport->render(); ?>
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