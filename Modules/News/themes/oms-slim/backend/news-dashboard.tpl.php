<?php /** @var \Modules\Media\Handler $this */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT, 1000701001]); ?>

<div class="b b-2 c7-2 c7" id="i7-2-1">
    <h1>
        <?= $this->app->user->localization->lang[7]['News']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <?php $list = $newsList->getList(); ?>
        <table>
            <?php for($i = 0; $i < 10; $i++) { ?>
            <tr>
                <td class="full"><?= $list['list'][$i]['title']; ?>
                <td><?= $list['list'][$i]['name1']; ?>
                <td class="nowrap"><?= $list['list'][$i]['created']; ?>
            <?php } ?>
        </table>
    </div>
</div>

<div class="b b-2 c7-2 c7" id="i7-2-2">
    <h1>
        <?= $this->app->user->localization->lang[7]['Headlines']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <table>
            <?php for($i = 0; $i < 10; $i++) { ?>
            <tr>
                <td class="full"><?= $list['list'][$i]['title']; ?>
                <td><?= $list['list'][$i]['name1']; ?>
                <td class="nowrap"><?= $list['list'][$i]['created']; ?>
            <?php } ?>
        </table>
    </div>
</div>