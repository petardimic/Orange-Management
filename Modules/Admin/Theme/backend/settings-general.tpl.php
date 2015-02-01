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

/*
 * Template
 */

//echo $this->getView('nav::top')->getResponse();
echo $this->getView('settings::page')->getResponse();
echo $this->getView('settings::l11n')->getResponse();
echo $this->getView('settings::accounts')->getResponse();