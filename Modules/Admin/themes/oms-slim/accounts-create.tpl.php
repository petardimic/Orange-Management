<?php /** @var \Modules\Admin\Admin $this */
\Framework\Modules\ModuleFactory::$initialized[1000500000]->show([3, 1000104001]);
?>

<div class="b b-2 c1-8 c1" id="i1-8-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Account']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-status"><?= \Framework\Localization\Localization::$lang[1]['Status']; ?></label>
                </li>
                <li>
                    <select name="status" id="i-status">
                        <option value="0">
                            <?= \Framework\Localization\Localization::$lang[1]['Active']; ?>
                        </option>
                        <option value="1">
                            <?= \Framework\Localization\Localization::$lang[1]['Inactive']; ?>
                        </option>
                    </select>
                </li>
                <li>
                    <label for="i-type"><?= \Framework\Localization\Localization::$lang[1]['Type']; ?></label>
                </li>
                <li>
                    <select name="type" id="i-type">
                        <option value="0">
                            <?= \Framework\Localization\Localization::$lang[1]['Single']; ?>
                        </option>
                        <option value="1">
                            <?= \Framework\Localization\Localization::$lang[1]['Group']; ?>
                        </option>
                    </select>
                </li>
                <li>
                    <label for="i-active"><?= \Framework\Localization\Localization::$lang[1]['Activity']; ?></label>
                </li>
                <li>
                    <input name="active" class="i-1 t-i" id="i-active" type="text">
                </li>
                <li>
                    <label for="i-created"><?= \Framework\Localization\Localization::$lang[1]['Created']; ?></label>
                </li>
                <li>
                    <input name="created" class="i-1 t-i" id="i-created" type="text">
                </li>
                <li>
                </li>
            </ul>
        </form>
    </div>
</div>

<div class="b b-2 c1-8 c1" id="i1-8-3">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Account']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-login"><?= \Framework\Localization\Localization::$lang[1]['Loginname']; ?></label>
                </li>
                <li>
                    <input name="login" class="i-1 t-i" id="i-login" type="text">
                </li>
                <li>
                    <label for="i-name1"><?= \Framework\Localization\Localization::$lang[1]['Name1']; ?></label>
                </li>
                <li>
                    <input name="name1" class="i-1 t-i" id="i-name1" type="text">
                </li>
                <li>
                    <label for="i-name2"><?= \Framework\Localization\Localization::$lang[1]['Name2']; ?></label>
                </li>
                <li>
                    <input name="name2" class="i-1 t-i" id="i-name2" type="text">
                </li>
                <li>
                    <label for="i-name3"><?= \Framework\Localization\Localization::$lang[1]['Name3']; ?></label>
                </li>
                <li>
                    <input name="name3" class="i-1 t-i" id="i-name3" type="text">
                </li>
                <li>
                    <label for="i-email"><?= \Framework\Localization\Localization::$lang[0]['Email']; ?></label>
                </li>
                <li>
                    <input name="email" class="i-1 t-i" id="i-email" type="text">
                </li>
                <li>
                    <label for="i-pass"><?= \Framework\Localization\Localization::$lang[0]['Password']; ?></label>
                </li>
                <li>
                    <input name="pass" class="i-1 t-i" id="i-pass" type="password">
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Create']; ?>">
                </li>
                <li>
                </li>
            </ul>
        </form>
    </div>
</div>

<div class="c-bar rT">
    <button><?= \Framework\Localization\Localization::$lang[0]['Create']; ?></button>
    <button><?= \Framework\Localization\Localization::$lang[0]['Cancel']; ?></div>

