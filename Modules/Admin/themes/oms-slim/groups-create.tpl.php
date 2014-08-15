<?php /** @var \Modules\Admin\Admin $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([3, 1000103001]);
?>

<div class="b b-2 c1-9 c1" id="i1-9-1">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Group']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <div class="bc-1">
            <form class="f-1">
                <ul class="l-1">
                    <li>
                        <label for="i-id"><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                    <li>
                        <input name="id" class="i-1 t-i" id="i-id" type="text">
                    <li>
                        <label for="i-name"><?= \Framework\Localization\Localization::$lang[1]['Name']; ?></label>
                    <li>
                        <input name="name" class="i-1 t-i" id="i-name" type="text">
                    <li>
                        <label
                            for="i-desc"><?= \Framework\Localization\Localization::$lang[1]['Description']; ?></label>
                    <li>
                        <textarea name="desc" id="i-desc"></textarea>
                    <li>
                        <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Create']; ?>">
                </ul>
            </form>
        </div>
    </div>
</div>

<div class="b b-2 c1-9 c1" id="i1-9-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Parents']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">

    </div>
</div>

<div class="c-bar rT">
    <button><?= \Framework\Localization\Localization::$lang[0]['Create']; ?></button>
    <button><?= \Framework\Localization\Localization::$lang[0]['Cancel']; ?></div>