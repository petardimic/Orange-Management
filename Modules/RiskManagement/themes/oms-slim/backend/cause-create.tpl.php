<?php /** @var \Modules\RiskManagement\Handler $this */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT, 1003001001]);
?>

<div class="b b-2 c30-1 c30" id="i30-1-1">
    <h1>
        <?= $this->app->user->localization->lang[30]['Cause']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <ul class="l-1">
            <li><?= $this->app->user->localization->lang[30]['Title']; ?>
            <li><input type="text">
            <li><?= $this->app->user->localization->lang[30]['Description']; ?>
            <li><input type="text">
            <li><?= $this->app->user->localization->lang[30]['Unit']; ?>
            <li><input type="text">
            <li><?= $this->app->user->localization->lang[30]['Probability']; ?>
            <li><input type="text">
            <li><?= $this->app->user->localization->lang[30]['Risk']; ?>
            <li><input type="text">
            <li><?= $this->app->user->localization->lang[30]['Department']; ?>
            <li><input type="text">
            <li><?= $this->app->user->localization->lang[30]['Category']; ?>
            <li><input type="text">
        </ul>
    </div>
</div>
