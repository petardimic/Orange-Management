<?php
/*
 * UI Logic
 */

/**
 * @var \Framework\Views\ViewAbstract $this
 */
$panelPageView = new \Web\Views\Panel\PanelView($this->l11n);
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
$formPageView->setData('submit', $this->l11n->lang[0]['Submit']);
$formPageView->setAction('http://127.0.0.1');
$formPageView->setMethod(\Framework\Message\RequestType::POST);

$formPageView->setElement(0, 0, [
   'type' => \Framework\Html\TagType::INPUT,
   'subtype' => 'text',
   'name' => 'oname',
   'placeholder' => 'Orange Management'
]);

$formPageView->setElement(1, 0, [
    'type' => \Framework\Html\TagType::INPUT,
    'subtype' => 'text',
    'name' => 'laddr',
]);

$formPageView->setElement(2, 0, [
    'type' => \Framework\Html\TagType::INPUT,
    'subtype' => 'text',
    'name' => 'raddr',
]);

$formPageView->setElement(3, 0, [
    'type' => \Framework\Html\TagType::INPUT,
    'subtype' => 'checkbox',
    'name' => 'cache',
]);

$this->getView('settings::page')->addView('form', $formPageView);

/*
 * Localization
 */

$formLocalizationView = new \Web\Views\Form\FormView($this->l11n);
$formLocalizationView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formLocalizationView->setData('submit', $this->l11n->lang[0]['Submit']);
$formLocalizationView->setAction('http://127.0.0.1');
$formLocalizationView->setMethod(\Framework\Message\RequestType::POST);

$locals = \Framework\Localization\Localization::getLocals();
$formLocalizationView->setElement(0, 0, [
    'type' => \Framework\Html\TagType::SELECT,
    'options' => [],
    'selected' => '',
    'name' => 'lang'
]);

$formLocalizationView->setElement(1, 0, [
    'type' => \Framework\Html\TagType::SELECT,
    'options' => [],
    'selected' => '',
    'name' => 'country'
]);

$formLocalizationView->setElement(2, 0, [
    'type' => \Framework\Html\TagType::INPUT,
    'subtype' => 'text',
    'name' => 'timezone',
    'placeholder' => 'Europe/London',
]);

$formLocalizationView->setElement(3, 0, [
    'type' => \Framework\Html\TagType::INPUT,
    'subtype' => 'text',
    'name' => 'datetime',
    'placeholder' => 'YYYY-MM-DD hh:mm:ss',
]);

$formLocalizationView->setElement(4, 0, [
    'type' => \Framework\Html\TagType::SELECT,
    'options' => [],
    'selected' => '',
    'name' => 'currency'
]);

$formLocalizationView->setElement(5, 0, [
    'type' => \Framework\Html\TagType::SELECT,
    'options' => [],
    'selected' => '',
    'name' => 'nformat'
]);

$this->getView('settings::l11n')->addView('form', $formLocalizationView);

/*
 * Template
 */

echo $this->getView('settings::page')->getResponse();
echo $this->getView('settings::l11n')->getResponse();