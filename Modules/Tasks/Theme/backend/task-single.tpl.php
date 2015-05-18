<?php
/**
 * @var \phpOMS\Views\View $this
 */

$task = new \Modules\Tasks\Models\Task(null);

/*
* Navigation
*/
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1001101001);
?>
<?= $nav->render(); ?>
<div class="b b-3 c7-1 c7" id="i7-1-1">
    <div class="bc-1">
        <select>
            <option></option>
        </select>
    </div>
</div>

<div class="b b-3 c7-1 c7" id="i7-1-1">
    <h1>
        <?= $task->getTitle(); ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <span><?= $task->getCreated()->format('Y-m-d H:i:s'); ?></span>
        <span><?= $task->getDue()->format('Y-m-d H:i:s'); ?></span>
        <span><?= $task->getDone()->format('Y-m-d H:i:s'); ?></span> <span><?= $task->getStatus(); ?></span>
        <span><?= $task->getCreator(); ?></span>
        <?= $task->getDescription(); ?>
    </div>
</div>

<?php
$elements = $task->getTaskElements();
foreach($elements as $element): ?>
    <div class="b b-3 c7-1 c7" id="i7-1-1">
        <div class="bc-1">
            <span><?= $element->getCreated()->format('Y-m-d H:i:s'); ?></span>
            <span><?= $element->getDue()->format('Y-m-d H:i:s'); ?></span> <span><?= $element->getStatus(); ?></span>
            <span><?= $element->getForwarded(); ?></span> <span><?= $element->getCreator(); ?></span>
            <?= $element->getDescription(); ?>
        </div>
    </div>
<?php endforeach; ?>

<div class="b b-3 c7-1 c7" id="i7-1-1">
    <div class="bc-1">
        <ul class="l-1">
            <li>
                <lable><?= $this->l11n->lang[11]['Receiver']; ?></lable>
            <li><input type="text">
            <li>
                <lable><?= $this->l11n->lang[11]['Due']; ?></lable>
            <li><input type="text">
            <li>
                <lable><?= $this->l11n->lang[11]['Message']; ?></lable>
            <li><textarea style="width: 100%"></textarea>
        </ul>
        <button class="rf"><?= $this->l11n->lang[0]['Submit']; ?></button>
        <div class="clearfix"></div>
    </div>
</div>