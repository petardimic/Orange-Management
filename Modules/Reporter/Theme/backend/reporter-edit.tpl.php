<?php

/**
 * @var \phpOMS\Views\View $this
 */
$tabView = new \Web\Views\Divider\TabularView($this->l11n);
$tabView->setTemplate('/Web/Theme/Templates/Divider/Tabular');

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
                <li><a href="<?= \phpOMS\Uri\UriFactory::build([$this->l11n->getLanguage(),
                                                                'backend',
                                                                'reporter',
                                                                'single'], ['id' => $this->getData('name')]); ?>"
                       class="button"><?= $this->l11n->lang[27]['Report']; ?></a>
            </ul>
        </div>
    </div>
</div>
<div class="b-6">
    <?php
    /**
     * @var \phpOMS\Views\View $this
     */
    $overviwPanel    = new \Web\Views\Panel\PanelView($this->l11n);
    $permissionPanel = clone $overviwPanel;

    $overviwPanel->setTitle($this->l11n->lang[0]['Create']);
    $permissionPanel->setTitle($this->l11n->lang[27]['Permission']);

    $this->addView('createFormPanel', $overviwPanel);
    $this->getView('createFormPanel')->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');

    $this->addView('permissionFormPanel', $permissionPanel);
    $this->getView('permissionFormPanel')->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');

    /*
     * Overview
     */

    $formOverview = new \Web\Views\Form\FormView($this->l11n);
    $formOverview->setTemplate('/Web/Theme/Templates/Forms/FormFull');
    $formOverview->setSubmit('submit1', $this->l11n->lang[27]['Edit']);
    $formOverview->setSubmit('submit2', $this->l11n->lang[0]['Delete']);
    $formOverview->setAction('http://127.0.0.1');
    $formOverview->setMethod(\phpOMS\Message\RequestMethod::POST);

    $formOverview->setElement(0, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'rname',
        'label'   => $this->l11n->lang[27]['Name']
    ]);

    $formOverview->setElement(1, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'mdirectory',
        'label'   => $this->l11n->lang[27]['MediaDirectory'],
        'active'  => false
    ]);

    $formOverview->setElement(1, 1, [
        'type'    => \phpOMS\Html\TagType::BUTTON,
        'content' => $this->l11n->lang[27]['Select'],
    ]);

    $formOverview->setElement(2, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'template',
        'label'   => $this->l11n->lang[27]['Template'],
        'active'  => false
    ]);

    $formOverview->setElement(2, 1, [
        'type'    => \phpOMS\Html\TagType::BUTTON,
        'content' => $this->l11n->lang[27]['Select']
    ]);

    $this->getView('createFormPanel')->addView('form', $formOverview);

    /*
     * Permission Add
     */

    $formPermissionAdd = new \Web\Views\Form\FormView($this->l11n);
    $formPermissionAdd->setTemplate('/Web/Theme/Templates/Forms/FormFull');
    $formPermissionAdd->setSubmit('submit1', $this->l11n->lang[0]['Add']);
    $formPermissionAdd->setAction('http://127.0.0.1');
    $formPermissionAdd->setMethod(\phpOMS\Message\RequestMethod::POST);

    $formPermissionAdd->setElement(0, 0, [
        'type'     => \phpOMS\Html\TagType::SELECT,
        'options'  => [
            [
                'value'   => 0,
                'content' => 'Group'
            ],
            [
                'value'   => 1,
                'content' => 'Account'
            ],
        ],
        'selected' => '',
        'label'    => $this->l11n->lang[27]['Type'],
        'name'     => 'type'
    ]);

    $formPermissionAdd->setElement(1, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'id',
        'label'   => $this->l11n->lang[0]['ID']
    ]);

    $formPermissionAdd->setElement(2, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'perm',
        'label'   => $this->l11n->lang[27]['Permission']
    ]);

    $this->getView('permissionFormPanel')->addView('form', $formPermissionAdd);

    /*
     * Permission List
     */
    $permissionListView = new \Web\Views\Lists\ListView($this->l11n);
    $headerView         = new \Web\Views\Lists\HeaderView($this->l11n);

    $permissionListView->setTemplate('/Web/Theme/Templates/Lists/ListFull');
    $headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

    /*
     * Header
     */
    $headerView->setTitle($this->l11n->lang[27]['Permission']);
    $headerView->setHeader([
        ['title' => $this->l11n->lang[27]['Type'], 'sortable' => true],
        ['title' => $this->l11n->lang[27]['Name'], 'sortable' => true, 'full' => true],
        ['title' => $this->l11n->lang[27]['Permission'], 'sortable' => true]
    ]);

    $permissionListView->addView('header', $headerView);
    $this->addView('permissionList', $permissionListView);

    $tabView->addTab($this->l11n->lang[27]['Overview'], $overviwPanel->getOutput() . $permissionPanel->getOutput() . $permissionListView->getOutput(), 'overview');

    /*
 * UI Logic
 */
    $sourceList           = new \Web\Views\Lists\ListView($this->l11n);
    $sourceListHeaderView = new \Web\Views\Lists\HeaderView($this->l11n);

    $sourceList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
    $sourceListHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

    /*
     * Header
     */
    $sourceListHeaderView->setTitle($this->l11n->lang[27]['Sources']);
    $sourceListHeaderView->setHeader([
        ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
        ['title' => $this->l11n->lang[27]['Name'], 'sortable' => true, 'full' => true],
        ['title' => $this->l11n->lang[27]['Created'], 'sortable' => true],
        ['title' => $this->l11n->lang[27]['CreatedBy'], 'sortable' => true],
    ]);

    $sourceList->setFreeze(3, 2);
    $sourceList->addView('header', $sourceListHeaderView);

    $tabView->addTab($this->l11n->lang[27]['Sources'], $sourceList->getOutput(), 'sources');

    /*
     * Create
     */
    $createPanel = new \Web\Views\Panel\PanelView($this->l11n);
    $mediaPanel  = clone $createPanel;

    $createPanel->setTitle($this->l11n->lang[0]['Create']);
    $mediaPanel->setTitle($this->l11n->lang[27]['Media']);

    $this->addView('createFormPanel', $createPanel);
    $this->getView('createFormPanel')->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');

    $this->addView('permissionFormPanel', $mediaPanel);
    $this->getView('permissionFormPanel')->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');

    $formCreateForm = new \Web\Views\Form\FormView($this->l11n);
    $formCreateForm->setTemplate('/Web/Theme/Templates/Forms/FormFull');
    $formCreateForm->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
    $formCreateForm->setAction('http://127.0.0.1');
    $formCreateForm->setMethod(\phpOMS\Message\RequestMethod::POST);

    $formCreateForm->setElement(0, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'rname',
        'label'   => $this->l11n->lang[27]['Name']
    ]);

    $createPanel->addView('createform', $formCreateForm);

    /*
     * Media Add
     */

    // TODO: add media upload drop panel

    $tabView->addTab($this->l11n->lang[27]['New'], $createPanel->getOutput() . $mediaPanel->getOutput(), 'new');
    ?>
    <?= $tabView->getOutput(); ?>
</div>

<script>
    oLib.ready(function () {
        assetManager.load(URL + '/Modules/Media/JS', 'MediaUpload.js', 'js');
    });
</script>