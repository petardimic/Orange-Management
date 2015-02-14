<?php /** @var \Modules\RiskManagement\Controller $this */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call(\phpOMS\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1003001001]);
?>
<div class="b b-2 c30-1 c30" id="i30-1-1">
    <h1>
        <?= $this->app->user->getL11n()->lang[30]['Risk']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <ul class="l-1">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Title']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Description']; ?></label>
            <li><textarea></textarea>
            <li><label><?= $this->app->user->getL11n()->lang[30]['Responsible']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Unit']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Department']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Category']; ?></label>
            <li><input type="text">
        </ul>
    </div>
</div>

<div class="b b-2 c30-1 c30" id="i30-1-1">
    <h1>
        <?= $this->app->user->getL11n()->lang[30]['Risk']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <ul class="l-1">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Probability']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Damage']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Parent']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Process']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Project']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Limit']; ?></label>
            <li><input type="text">
            <li><label><?= $this->app->user->getL11n()->lang[30]['Interval']; ?></label>
            <li><input type="text">
        </ul>
    </div>
</div>

<div class="c-bar rT">
    <button><?= $this->app->user->getL11n()->lang[0]['Create']; ?></button>
    <button><?= $this->app->user->getL11n()->lang[0]['Cancel']; ?></div>