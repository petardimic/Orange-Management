<?php
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000401001]);
?>

<div class="b b-3 c4-2 c4" id="i4-2-1">
    <h1>
        <?= $this->app->user->getL11n()->lang[4]['Preview']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <div style="min-height: 150px">
            Drag or click here for upload!
        </div>
        <button class="rf"><?= $this->app->user->getL11n()->lang[0]['Submit']; ?></button>
        <div class="clearfix"></div>
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
                <td><input type="text">
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Extension']; ?></label>
                <td>?
            <tr>
                <th><label><?= $this->app->user->getL11n()->lang[4]['Size']; ?></label>
                <td>0 kb
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
