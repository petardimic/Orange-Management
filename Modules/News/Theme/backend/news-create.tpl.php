<?php
/**
 * @var \phpOMS\Views\ViewAbstract $this
 */

/*
 * Settings
 */
$createPanel = new \Web\Views\Panel\PanelView($this->l11n);
$createPanel->setTitle($this->l11n->lang[7]['Settings']);
$this->addView('settingsPanel', $createPanel);
$this->getView('settingsPanel')->setTemplate('/Web/Theme/Templates/Panel/BoxFull');

$formSettingsView = new \Web\Views\Form\FormView($this->l11n);
$formSettingsView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formSettingsView->setSubmit('submit1', $this->l11n->lang[0]['Save']);
$formSettingsView->setSubmit('delete', $this->l11n->lang[0]['Delete']);
$formSettingsView->setSubmit('publish', $this->l11n->lang[7]['Publish'], ['visible' => true, 'float' => 1]);
$formSettingsView->setAction('http://127.0.0.1');
$formSettingsView->setMethod(\phpOMS\Message\RequestType::POST);

$formSettingsView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        [
            'value'   => 0,
            'content' => $this->l11n->lang[7]['News']
        ],
        [
            'value'    => 1,
            'content'  => $this->l11n->lang[7]['Headline'],
            'selected' => true
        ]
    ],
    'name'    => 'type',
    'label'   => $this->l11n->lang[7]['Type']
]);

$formSettingsView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        [
            'value'   => 0,
            'content' => $this->l11n->lang[7]['Draft']
        ],
        [
            'value'    => 1,
            'content'  => $this->l11n->lang[7]['Visible'],
            'selected' => true
        ]
    ],
    'name'    => 'status',
    'label'   => $this->l11n->lang[7]['Status']
]);

$formSettingsView->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'datetime-local',
    'name'    => 'publish',
    'label'   => $this->l11n->lang[7]['Publish']
]);

$this->getView('settingsPanel')->addView('form', $formSettingsView);

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
    <?= $this->getView('settingsPanel')->getOutput(); ?>

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