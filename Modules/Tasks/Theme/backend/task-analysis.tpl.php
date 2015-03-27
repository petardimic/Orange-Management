<?php
/**
 * @var \phpOMS\Views\View $this
 */

/**
 * @var \phpOMS\Views\View $this
 */
$panelSelectView = new \Web\Views\Panel\PanelView($this->l11n);
$panelSelectView->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');
$panelSelectView->setTitle($this->l11n->lang[11]['Person']);
$this->addView('select::person', $panelSelectView);

$settingsFormView = new \Web\Views\Form\FormView($this->l11n);
$settingsFormView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$settingsFormView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$settingsFormView->setAction('http://127.0.0.1');
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type' => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label' => $this->l11n->lang[11]['Person'],
    'name' => 'person',
]);

$settingsFormView->setElement(1, 0, [
    'type' => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'date',
    'label' => $this->l11n->lang[11]['From'],
    'name' => 'date-from',
]);

$settingsFormView->setElement(1, 1, [
    'type' => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'date',
    'label' => $this->l11n->lang[11]['To'],
    'name' => 'date-to',
]);

$this->getView('select::person')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->l11n);
$panelStatView->setTemplate('/Web/Theme/Templates/Panel/BoxHalf');
$panelStatView->setTitle($this->l11n->lang[11]['Statistics']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->l11n);
$statTableView->setTemplate('/Web/Theme/Templates/Lists/AssocList');
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
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1001101001);
?>
<?= $nav->getOutput(); ?>

<?= $this->getView('select::person')->getOutput(); ?>

<!-- Analyse how many tasks that a user created got finished in time in order to see if he/she creates realistic estimates -->
<?= $this->getView('stats')->getOutput(); ?>