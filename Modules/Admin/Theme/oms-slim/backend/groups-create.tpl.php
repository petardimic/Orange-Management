<?php /** @var \Modules\Admin\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000103001]);
?>

<div class="b b-2 c1-9 c1" id="i1-9-1">
    <h1>
        <?= $this->app->user->localization->lang[1]['Group']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <div class="bc-1">
            <form class="f-1">
                <ul class="l-1">
                    <li>
                        <label for="i-id"><?= $this->app->user->localization->lang[0]['ID']; ?></label>
                    <li>
                        <input name="id" class="i-1 t-i" id="i-id" type="text">
                    <li>
                        <label for="i-name"><?= $this->app->user->localization->lang[1]['Name']; ?></label>
                    <li>
                        <input name="name" class="i-1 t-i" id="i-name" type="text">
                    <li>
                        <label
                            for="i-desc"><?= $this->app->user->localization->lang[1]['Description']; ?></label>
                    <li>
                        <textarea name="desc" id="i-desc"></textarea>
                    <li>
                        <input type="button" value="<?= $this->app->user->localization->lang[0]['Create']; ?>">
                </ul>
            </form>
        </div>
    </div>
</div>

<div class="b b-2 c1-9 c1" id="i1-9-2">
    <h1>
        <?= $this->app->user->localization->lang[1]['Parents']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">

    </div>
</div>

<div class="c-bar rT">
    <button><?= $this->app->user->localization->lang[0]['Create']; ?></button>
    <button><?= $this->app->user->localization->lang[0]['Cancel']; ?></div>