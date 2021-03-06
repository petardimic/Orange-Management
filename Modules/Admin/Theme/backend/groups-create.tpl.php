<?php
/*
 * UI Logic
 */

/**
 * @var \phpOMS\Views\View $this
 */
$panelCreate = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$panelCreate->setTitle($this->l11n->lang[1]['Group']);

$this->addView('group:create', $panelCreate);
$this->getView('group:create')->setTemplate('/Web/Templates/Panel/BoxThird');

/*
 * General
 */

$formGroupCreate = new \Web\Views\Form\FormView($this->l11n, $this->request, $this->response);
$formGroupCreate->setTemplate('/Web/Templates/Forms/FormFull');
$formGroupCreate->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formGroupCreate->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formGroupCreate->setMethod(\phpOMS\Message\RequestMethod::POST);

$formGroupCreate->setElement(0, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'name'        => 'gid',
    'label'       => $this->l11n->lang[0]['ID'],
    'placeholder' => 'unique_group_id',
    'regex'       => '[a-zA-Z0-9_\-+/]*'
]);

$formGroupCreate->setElement(1, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'label'       => $this->l11n->lang[1]['Name'],
    'name'        => 'gname',
    'placeholder' => $this->l11n->lang[1]['Group']
]);

$formGroupCreate->setElement(2, 0, [
    'type'  => \phpOMS\Html\TagType::TEXTAREA,
    'label' => $this->l11n->lang[1]['Description'],
    'name'  => 'gdesc',
]);

$this->getView('group:create')->addView('form', $formGroupCreate);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000103001);
?>
<?= $nav->render(); ?>

<?= $this->getView('group:create')->render(); ?>

<div class="b b-3 c1-9 c1" id="i1-9-2">
    <h1>
        <?= $this->l11n->lang[1]['Parents']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">

    </div>
</div>

<div class="c-bar rT">
    <button><?= $this->l11n->lang[0]['Create']; ?></button>
    <button><?= $this->l11n->lang[0]['Cancel']; ?></div>