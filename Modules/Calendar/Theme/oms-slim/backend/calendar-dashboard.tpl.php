<?php /** @var \Modules\Profile\Controller $this */
?>
<div class="b-7" id="i3-2-1">
    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <div class="m-calendar-mini">

        </div>
    </div>
    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->app->user->localization->lang[9]['Settings']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <ul class="l-1">
                <li><?= $this->app->user->localization->lang[9]['Interval']; ?>
                <li><select>
                        <option value="1"><?= $this->app->user->localization->lang[9]['Day']; ?>
                        <option value="2"><?= $this->app->user->localization->lang[9]['Week']; ?>
                        <option value="3" selected><?= $this->app->user->localization->lang[9]['Month']; ?>
                        <option value="4"><?= $this->app->user->localization->lang[9]['Year']; ?>
                    </select>
            </ul>
        </div>
    </div>
</div>
<div class="b-6" id="i3-2-2">
    <div class="m-calendar" data-settings='{"interval": 3, "active": []}'>

    </div>
</div>