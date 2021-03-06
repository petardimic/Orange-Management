<?php
/**
 * @var \phpOMS\Views\View $this
 */
$createPanel = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$mediaPanel  = clone $createPanel;

$createPanel->setTitle($this->l11n->lang[0]['Create']);
$mediaPanel->setTitle($this->l11n->lang[11]['Media']);

$this->addView('createFormPanel', $createPanel);
$this->getView('createFormPanel')->setTemplate('/Web/Templates/Panel/BoxHalf');

$this->addView('mediaPanel', $mediaPanel);
$this->getView('mediaPanel')->setTemplate('/Web/Templates/Panel/BoxHalf');

/*
 * Create
 */

$formCreateForm = new \Web\Views\Form\FormView($this->l11n, $this->request, $this->response);
$formCreateForm->setTemplate('/Web/Templates/Forms/FormFull');
$formCreateForm->setSubmit('submit1', $this->l11n->lang[0]['Create']);
$formCreateForm->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost() . '/' . $this->l11n->getLanguage() . '/api/task/create.php');
$formCreateForm->setMethod(\phpOMS\Message\RequestMethod::POST);

$formCreateForm->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        [
            'value'    => 0,
            'content'  => $this->l11n->lang[11]['Default'],
            'selected' => true
        ] // this can be used for pre designed tasks (receiver + different templates)
    ],
    'name'    => 'template',
    'label'   => $this->l11n->lang[11]['Template']
]);

$formCreateForm->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        [
            'value'   => 0,
            'content' => $this->l11n->lang[11]['Group']
        ],
        [
            'value'    => 1,
            'content'  => $this->l11n->lang[11]['Account'],
            'selected' => true
        ],
    ],
    'name'    => 'rtype',
    'label'   => $this->l11n->lang[11]['Type']
]);

$formCreateForm->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'receiver',
    'label'   => $this->l11n->lang[11]['Receiver']
]);

$formCreateForm->setElement(3, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'checkbox',
    'name'    => 'visibility',
    'checked' => true,
    'label'   => $this->l11n->lang[11]['SharedVisibility']
]);

$formCreateForm->setElement(4, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'datetime-local',
    'name'    => 'due',
    'label'   => $this->l11n->lang[11]['Due']
]);

$formCreateForm->setElement(5, 0, [
    'type'  => \phpOMS\Html\TagType::TEXTAREA,
    'name'  => 'msg',
    'label' => $this->l11n->lang[11]['Message']
]);

$this->getView('createFormPanel')->addView('form', $formCreateForm);

/*
 * Media
 */

$mediaForm = new \Web\Views\Form\FormView($this->l11n, $this->request, $this->response);
$mediaForm->setTemplate('/Web/Templates/Forms/FormFull');
$mediaForm->setSubmit('submit1', $this->l11n->lang[0]['Add']);
$mediaForm->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$mediaForm->setMethod(\phpOMS\Message\RequestMethod::POST);

$mediaForm->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'media',
    'label'   => $this->l11n->lang[11]['Media']
]);

$mediaForm->setElement(0, 1, [
    'type'    => \phpOMS\Html\TagType::BUTTON,
    'content' => $this->l11n->lang[11]['Select']
]);

$this->getView('mediaPanel')->addView('form', $mediaForm);

/*
 * Permission List
 */
$mediaListView = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$headerView    = new \Web\Views\Lists\HeaderView($this->l11n, $this->request, $this->response);

$mediaListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[11]['Media']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[11]['Type'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang[11]['Size'], 'sortable' => true]
]);

$mediaListView->addView('header', $headerView);
$this->addView('mediaList', $mediaListView);

/*
* Navigation
*/
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1001101001);
?>
<?= $nav->render(); ?>

<?= $this->getView('createFormPanel')->render(); ?>
<?= $this->getView('mediaPanel')->render(); ?>
<?= $this->getView('mediaList')->render(); ?>