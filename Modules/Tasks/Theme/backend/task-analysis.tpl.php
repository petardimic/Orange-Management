<?php
/**
 * @var \phpOMS\Views\View $this
 */

/**
 * @var \phpOMS\Views\View $this
 */
$panelSelectView = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$panelSelectView->setTemplate('/Web/Templates/Panel/BoxHalf');
$panelSelectView->setTitle($this->l11n->lang[11]['Person']);
$this->addView('select::person', $panelSelectView);

$settingsFormView = new \Web\Views\Form\FormView($this->l11n, $this->request, $this->response);
$settingsFormView->setTemplate('/Web/Templates/Forms/FormFull');
$settingsFormView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[11]['Person'],
    'name'    => 'person',
]);

$settingsFormView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'date',
    'label'   => $this->l11n->lang[11]['From'],
    'name'    => 'date-from',
]);

$settingsFormView->setElement(1, 1, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'date',
    'label'   => $this->l11n->lang[11]['To'],
    'name'    => 'date-to',
]);

$this->getView('select::person')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->l11n, $this->request, $this->response);
$panelStatView->setTemplate('/Web/Templates/Panel/BoxHalf');
$panelStatView->setTitle($this->l11n->lang[11]['Statistics']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->l11n, $this->request, $this->response);
$statTableView->setTemplate('/Web/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang[11]['Received'], 0],
    [$this->l11n->lang[11]['Created'], 0],
    [$this->l11n->lang[11]['Forwarded'], 0],
    [$this->l11n->lang[11]['AverageAmount'], 0],
    [$this->l11n->lang[11]['AverageProcessTime'], 0],
    [$this->l11n->lang[11]['InTime'], 0],
]);

$this->getView('stats')->addView('stat::table', $statTableView);

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

<?= $this->getView('select::person')->render(); ?>

    <!-- Analyse how many tasks that a user created got finished in time in order to see if he/she creates realistic estimates -->
<?= $this->getView('stats')->render(); ?>