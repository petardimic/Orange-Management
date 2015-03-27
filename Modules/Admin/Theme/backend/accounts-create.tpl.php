<?php
/**
 * @var \phpOMS\Views\View $this
 */

$panelCoreSettingsView = new \Web\Views\Panel\PanelView($this->l11n);
$panelCoreSettingsView->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');
$panelCoreSettingsView->setTitle($this->l11n->lang[1]['Account']);
$this->addView('settings::core', $panelCoreSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->l11n);
$settingsFormView->setTemplate('/Web/Theme/Templates/Forms/FormInner');
$settingsFormView->setAction('http://127.0.0.1');
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang[1]['Active']],
        ['value' => 1, 'content' => $this->l11n->lang[1]['Inactive']],
    ],
    'selected' => 1,
    'label'    => $this->l11n->lang[1]['Status'],
    'name'     => 'status'
]);

$settingsFormView->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang[1]['Single']],
        ['value' => 1, 'content' => $this->l11n->lang[1]['Group']],
    ],
    'selected' => 1,
    'label'    => $this->l11n->lang[1]['Status'],
    'name'     => 'status'
]);

$this->getView('settings::core')->addView('form', $settingsFormView);

/*
 * Account name
 */

$panelNameSettingsView = new \Web\Views\Panel\PanelView($this->l11n);
$panelNameSettingsView->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');
$panelNameSettingsView->setTitle($this->l11n->lang[1]['Account']);
$this->addView('settings::name', $panelNameSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->l11n);
$settingsFormView->setTemplate('/Web/Theme/Templates/Forms/FormInner');
$settingsFormView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$settingsFormView->setAction('http://127.0.0.1');
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[1]['Loginname'],
    'name'    => 'loginname',
]);

$settingsFormView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[1]['Name1'],
    'name'    => 'name1',
]);

$settingsFormView->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[1]['Name2'],
    'name'    => 'name2',
]);

$settingsFormView->setElement(3, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[1]['Name3'],
    'name'    => 'name3',
]);

$settingsFormView->setElement(4, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[1]['Email'],
    'name'    => 'email',
]);

$settingsFormView->setElement(5, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[1]['Password'],
    'name'    => 'Password',
]);

$settingsFormView->setElement(5, 1, [
    'type'    => \phpOMS\Html\TagType::BUTTON,
    'content' => $this->l11n->lang[0]['Create'],
]);

$this->getView('settings::name')->addView('form', $settingsFormView);


/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000104001);
?>
<?= $nav->getOutput(); ?>

<form action="<?= \phpOMS\Uri\UriFactory::build([$this->l11n->getLanguage(), 'api', 'admin', 'account']); ?>" method="POST">
    <?= $this->getView('settings::core')->getOutput(); ?>

    <?= $this->getView('settings::name')->getOutput(); ?>
</form>