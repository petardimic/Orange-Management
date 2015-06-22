<?php
/**
 * @var \phpOMS\Views\View $this
 */

$panelCreate = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$panelCreate->setTitle($this->l11n->lang[47]['Unit']);

$this->addView('group:create', $panelCreate);
$this->getView('group:create')->setTemplate('/Web/Templates/Panel/BoxThird');

/*
 * General
 */

$formUnitCreate = new \Web\Views\Form\FormView($this->l11n, $this->request, $this->response);
$formUnitCreate->setTemplate('/Web/Templates/Forms/FormFull');
$formUnitCreate->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formUnitCreate->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
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
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1004702001);

/*
 * Template
 */
echo $nav->render();
echo $panelCreate->render();