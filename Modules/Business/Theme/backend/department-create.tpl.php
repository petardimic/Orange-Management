<?php
/**
 * @var \phpOMS\Views\View $this
 */

$panelCreate = new \Web\Views\Panel\PanelView($this->l11n, $this->response, $this->request);
$panelCreate->setTitle($this->l11n->lang[47]['Department']);

$this->addView('group:create', $panelCreate);
$this->getView('group:create')->setTemplate('/Web/Theme/Templates/Panel/BoxThird');

/*
 * General
 */

$formDepartmentCreate = new \Web\Views\Form\FormView($this->l11n, $this->response, $this->request);
$formDepartmentCreate->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formDepartmentCreate->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formDepartmentCreate->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formDepartmentCreate->setMethod(\phpOMS\Message\RequestMethod::POST);

$formDepartmentCreate->setElement(0, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'name'        => 'gid',
    'label'       => $this->l11n->lang[47]['Name']
]);

$formDepartmentCreate->setElement(1, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'label'       => $this->l11n->lang[47]['Parent'],
    'name'        => 'gname'
]);

$formDepartmentCreate->setElement(2, 0, [
    'type'  => \phpOMS\Html\TagType::TEXTAREA,
    'label' => $this->l11n->lang[47]['Description'],
    'name'  => 'gdesc',
]);

$panelCreate->addView('form', $formDepartmentCreate);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1004703001);

/*
 * Template
 */
echo $nav->getOutput();
echo $panelCreate->getOutput();