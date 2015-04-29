<?php
/**
 * @var \phpOMS\Views\View $this
 */

$panelCreate = new \Web\Views\Panel\PanelView($this->l11n);
$panelCreate->setTitle($this->l11n->lang[47]['Unit']);

$this->addView('group:create', $panelCreate);
$this->getView('group:create')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');

/*
 * General
 */

$formUnitCreate = new \Web\Views\Form\FormView($this->l11n);
$formUnitCreate->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formUnitCreate->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formUnitCreate->setAction('http://127.0.0.1');
$formUnitCreate->setMethod(\phpOMS\Message\RequestMethod::POST);

$formUnitCreate->setElement(0, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'name'        => 'gid',
    'label'       => $this->l11n->lang[47]['Name']
]);

$formUnitCreate->setElement(1, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'label'       => $this->l11n->lang[47]['Parent'],
    'name'        => 'gname'
]);

$formUnitCreate->setElement(2, 0, [
    'type'  => \phpOMS\Html\TagType::TEXTAREA,
    'label' => $this->l11n->lang[47]['Description'],
    'name'  => 'gdesc',
]);

$panelCreate->addView('form', $formUnitCreate);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1004702001);

/*
 * Template
 */
echo $nav->getOutput();
echo $panelCreate->getOutput();