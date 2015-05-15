<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * General
 */

$settingsFormView = new \Web\Views\Form\FormView($this->l11n);
$settingsFormView->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$settingsFormView->setHasSubmit(false);
$settingsFormView->setOnChange(true);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 1, 'content' => $this->l11n->lang[9]['Day'],],
        ['value' => 2, 'content' => $this->l11n->lang[9]['Week'],],
        ['value' => 3, 'content' => $this->l11n->lang[9]['Month'],],
        ['value' => 4, 'content' => $this->l11n->lang[9]['Year'],],
    ],
    'selected' => 3,
    'label'    => $this->l11n->lang[9]['Interval'],
    'name'     => 'interval'
]);

$settingsFormView->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 1, 'content' => $this->l11n->lang[9]['Blocks'],],
        ['value' => 2, 'content' => $this->l11n->lang[9]['List'],],
    ],
    'selected' => 1,
    'label'    => $this->l11n->lang[9]['Layout'],
    'name'     => 'layout'
]);
?>
<div class="b-7" id="i3-2-1">
    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <div class="m-calendar-mini">

        </div>
    </div>
    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->l11n->lang[9]['Settings']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <?= $settingsFormView->getOutput(); ?>
        </div>
    </div>
</div>
<div class="b-6" id="i3-2-2">
    <div class="m-calendar" data-settings='{"interval": 3, "active": []}'>

    </div>
</div>