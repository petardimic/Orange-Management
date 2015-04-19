<?php
/*
 * UI Logic
 */

/**
 * @var \phpOMS\Views\View $this
 */
$panelPageView         = new \Web\Views\Panel\PanelView($this->l11n);
$panelLocalizationView = clone $panelPageView;
$panelAccountsView     = clone $panelPageView;

$panelPageView->setTitle($this->l11n->lang[1]['Page']);
$panelLocalizationView->setTitle($this->l11n->lang[1]['Localization']);

$this->addView('settings::page', $panelPageView);
$this->addView('settings::l11n', $panelLocalizationView);
$this->addView('settings::accounts', $panelAccountsView);

//$this->getView('nav::top')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');
$this->getView('settings::page')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');
$this->getView('settings::l11n')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');

/*
 * General
 */

$formPageView = new \Web\Views\Form\FormView($this->l11n);
$formPageView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formPageView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formPageView->setAction('http://127.0.0.1');
$formPageView->setMethod(\phpOMS\Message\RequestMethod::POST);

$formPageView->setElement(0, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'name'        => 'oname',
    'label'       => $this->l11n->lang[1]['OName'],
    'placeholder' => 'Orange Management'
]);

$formPageView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[1]['LAddress'],
    'name'    => 'laddr',
]);

$formPageView->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[1]['RAddress'],
    'name'    => 'raddr',
]);

$formPageView->setElement(3, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'checkbox',
    'label'   => $this->l11n->lang[1]['Cache'],
    'name'    => 'cache',
]);

$this->getView('settings::page')->addView('form', $formPageView);

/*
 * Localization
 */

$formLocalizationView = new \Web\Views\Form\FormView($this->l11n);
$formLocalizationView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formLocalizationView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formLocalizationView->setAction('http://127.0.0.1');
$formLocalizationView->setMethod(\phpOMS\Message\RequestMethod::POST);

$formLocalizationView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [],
    'selected' => '',
    'label'    => $this->l11n->lang[1]['Language'],
    'name'     => 'lang'
]);

$formLocalizationView->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [],
    'selected' => '',
    'label'    => $this->l11n->lang[1]['Country'],
    'name'     => 'country'
]);

$formLocalizationView->setElement(2, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'label'       => $this->l11n->lang[1]['Timezone'],
    'name'        => 'timezone',
    'placeholder' => 'Europe/London',
]);

$formLocalizationView->setElement(3, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'name'        => 'datetime',
    'label'       => $this->l11n->lang[1]['Timeformat'],
    'placeholder' => 'YYYY-MM-DD hh:mm:ss',
]);

$formLocalizationView->setElement(4, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [],
    'selected' => '',
    'label'    => $this->l11n->lang[1]['Currency'],
    'name'     => 'currency'
]);

$formLocalizationView->setElement(5, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [],
    'selected' => '',
    'label'    => $this->l11n->lang[1]['Numberformat'],
    'name'     => 'nformat'
]);

$this->getView('settings::l11n')->addView('form', $formLocalizationView);

/*
 * Template
 */

echo $this->getView('settings::page')->getOutput();
echo $this->getView('settings::l11n')->getOutput();