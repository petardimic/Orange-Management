<?php
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000401001]);
?>

<div class="b b-3 c4-2 c4" id="i4-2-1">
    <h1>
        <?= $this->app->user->getL11n()->lang[4]['Preview']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
    </div>
</div>

<div class="b b-1 c4-2 c4" id="i4-2-2">
    <h1>
        <?= $this->app->user->getL11n()->lang[4]['Data']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <!-- @formatter:off -->
        <table class="tc-1">
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Name']; ?></label>
                <td><?= $media->getName(); ?>
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Extension']; ?></label>
                <td><?= $media->getExtension(); ?>
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Size']; ?></label>
                <td><?= \Framework\Utils\Converter\File::byteSizeToString($media->getSize()); ?>
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Author']; ?></label>
                <td><?= $media->getAuthor(); ?>
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Created']; ?></label>
                <td><?= $media->getCreated()->format('Y-m-d H:i:s'); ?>
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Changed']; ?></label>
                <td>asldkf
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Changedby']; ?></label>
                <td>asldkf
        </table>
        <!-- @formatter:on -->
    </div>
</div>


<div class="b b-1 c4-2 c4" id="i4-2-2">
    <h1>
        <?= $this->app->user->getL11n()->lang[4]['Settings']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <ul class="l-1">
            <li><label><?= $this->app->user->getL11n()->lang[4]['Visibility']; ?></label>
            <li><input type="text">
                <button><?= $this->app->user->getL11n()->lang[0]['Add']; ?></button>
            <li><label><?= $this->app->user->getL11n()->lang[4]['Editability']; ?></label>
            <li><input type="text">
                <button><?= $this->app->user->getL11n()->lang[0]['Add']; ?>
        </ul>
    </div>
</div>
