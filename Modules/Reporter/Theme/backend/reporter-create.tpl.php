<?php
/**
 * @var \phpOMS\Views\View $this
 */
$createPanel     = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$permissionPanel = clone $createPanel;

$createPanel->setTitle($this->l11n->lang[0]['Create']);
$permissionPanel->setTitle($this->l11n->lang[27]['Permission']);

$this->addView('createFormPanel', $createPanel);
$this->getView('createFormPanel')->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');

$this->addView('permissionFormPanel', $permissionPanel);
$this->getView('permissionFormPanel')->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');

/*
 * Create
 */

$formCreateForm = new \Web\Views\Form\FormView($this->l11n, $this->request, $this->response);
$formCreateForm->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formCreateForm->setSubmit('submit1', $this->l11n->lang[0]['Create']);
$formCreateForm->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formCreateForm->setMethod(\phpOMS\Message\RequestMethod::POST);

$formCreateForm->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'rname',
    'label'   => $this->l11n->lang[27]['Name']
]);

$formCreateForm->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'mdirectory',
    'label'   => $this->l11n->lang[27]['MediaDirectory'],
    'active'  => false
]);

$formCreateForm->setElement(1, 1, [
    'type'    => \phpOMS\Html\TagType::BUTTON,
    'content' => $this->l11n->lang[27]['New'],
]);

$formCreateForm->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'template',
    'label'   => $this->l11n->lang[27]['Template'],
    'active'  => false
]);

$formCreateForm->setElement(2, 1, [
    'type'    => \phpOMS\Html\TagType::BUTTON,
    'content' => $this->l11n->lang[27]['New']
]);

$this->getView('createFormPanel')->addView('form', $formCreateForm);

/*
 * Permission Add
 */

$formPermissionAdd = new \Web\Views\Form\FormView($this->l11n, $this->request, $this->response);
$formPermissionAdd->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$formPermissionAdd->setSubmit('submit1', $this->l11n->lang[0]['Add']);
$formPermissionAdd->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
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
$permissionListView = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$headerView         = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

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

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);
?>

<?= $nav->render(); ?>
<?= $this->getView('createFormPanel')->render(); ?>
<?= $this->getView('permissionFormPanel')->render(); ?>
<?= $this->getView('permissionList')->render(); ?>