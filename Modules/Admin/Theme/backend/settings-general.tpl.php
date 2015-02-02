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
$panelAccountsView->setTitle($this->l11n->lang[1]['Accounts']);

$this->addView('settings::page', $panelPageView);
$this->addView('settings::l11n', $panelLocalizationView);
$this->addView('settings::accounts', $panelAccountsView);

//$this->getView('nav::top')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');
$this->getView('settings::page')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');
$this->getView('settings::l11n')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');
$this->getView('settings::accounts')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');

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

$this->getView('settings::page')->addView('form', $formPageView);

/*
 * Template
 */

echo $this->getView('settings::page')->getResponse();
echo $this->getView('settings::l11n')->getResponse();
echo $this->getView('settings::accounts')->getResponse();