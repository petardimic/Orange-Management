<?php /** @var \Modules\Tasks\Handler $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT,
                                                                 1001101001]);
?>

    <div class="b b-3 c7-1 c7" id="i7-1-1">
        <h1>
            <?= /** @var \Modules\Tasks\Task $task */
            $task->getTitle(); ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <span><?= $task->getCreated()->format('Y-m-d H:i:s'); ?></span>
            <span><?= $task->getDue()->format('Y-m-d H:i:s'); ?></span>
            <span><?= $task->getDone()->format('Y-m-d H:i:s'); ?></span>
            <span><?= $task->getStatus(); ?></span>
            <span><?= $task->getCreator(); ?></span>
            <?= $task->getDescription(); ?>
        </div>
    </div>

<?php
$elements = $task->getTaskElements();
foreach($elements as $element) {
    ?>
    <div class="b b-3 c7-1 c7" id="i7-1-1">
        <div class="bc-1">
            <span><?= $element->getCreated()->format('Y-m-d H:i:s'); ?></span>
            <span><?= $element->getDue()->format('Y-m-d H:i:s'); ?></span>
            <span><?= $element->getStatus(); ?></span>
            <span><?= $element->getForwarded(); ?></span>
            <span><?= $element->getCreator(); ?></span>
            <?= $element->getDescription(); ?>
        </div>
    </div>
<?php } ?>