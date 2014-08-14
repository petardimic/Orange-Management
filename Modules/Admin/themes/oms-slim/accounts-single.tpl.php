<?php /** @var \Modules\Admin\Admin $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([3, 1000104300]);
?>

<div class="b b-1 c1-3 c1" id="i1-3-1">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Account']; /** @var \Modules\Admin\Admin $this */ ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <?php $account = \Framework\DataStorage\Database\Objects\User\User::getInstance((int)$this->app->request->uri['id'], $this->app); ?>
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-id"><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                </li>
                <li>
                    <input name="id" class="i-1 t-i" id="i-id" type="text"
                           value="<?= (int)$this->app->request->uri['id']; ?>" disabled>
                </li>
                <li>
                    <label for="i-status"><?= \Framework\Localization\Localization::$lang[1]['Status']; ?></label>
                </li>
                <li>
                    <select name="status" id="i-status">
                        <option value="0"<?= (0 === $account->status ? 'selected' : ''); ?>>
                            <?= \Framework\Localization\Localization::$lang[1]['Active']; ?>
                        </option>
                        <option value="1"<?= (1 === $account->status ? 'selected' : ''); ?>>
                            <?= \Framework\Localization\Localization::$lang[1]['Inactive']; ?>
                        </option>
                    </select>
                </li>
                <li>
                    <label for="i-type"><?= \Framework\Localization\Localization::$lang[1]['Type']; ?></label>
                </li>
                <li>
                    <select name="type" id="i-type">
                        <option value="0"<?= (0 === $account->type ? 'selected' : ''); ?>>
                            <?= \Framework\Localization\Localization::$lang[1]['Single']; ?>
                        </option>
                        <option value="1"<?= (1 === $account->type ? 'selected' : ''); ?>>
                            <?= \Framework\Localization\Localization::$lang[1]['Group']; ?>
                        </option>
                    </select>
                </li>
                <li>
                    <label for="i-active"><?= \Framework\Localization\Localization::$lang[1]['Activity']; ?></label>
                </li>
                <li>
                    <input name="active" class="i-1 t-i" id="i-active" type="text"
                           value="<?= $account->last_activity; ?>" disabled>
                </li>
                <li>
                    <label for="i-created"><?= \Framework\Localization\Localization::$lang[1]['Created']; ?></label>
                </li>
                <li>
                    <input name="created" class="i-1 t-i" id="i-created" type="text"
                           value="<?= $account->created; ?>" disabled>
                </li>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
                </li>
            </ul>
        </form>
    </div>
</div>

<div class="b b-1 c1-3 c1" id="i1-3-2">
    <h1>
        <?php
        echo \Framework\Localization\Localization::$lang[1]['Profile']; ?>
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
                    <input name="login" class="i-1 t-i" id="i-login" type="text"
                           value="<?= $account->login_name; ?>">
                </li>
                <li>
                    <label for="i-name1"><?= \Framework\Localization\Localization::$lang[1]['Name1']; ?></label>
                </li>
                <li>
                    <input name="name1" class="i-1 t-i" id="i-name1" type="text"
                           value="<?= $account->name[0]; ?>">
                </li>
                <li>
                    <label for="i-name2"><?= \Framework\Localization\Localization::$lang[1]['Name2']; ?></label>
                </li>
                <li>
                    <input name="name2" class="i-1 t-i" id="i-name2" type="text"
                           value="<?= $account->name[1]; ?>">
                </li>
                <li>
                    <label for="i-name3"><?= \Framework\Localization\Localization::$lang[1]['Name3']; ?></label>
                </li>
                <li>
                    <input name="name3" class="i-1 t-i" id="i-name3" type="text"
                           value="<?= $account->name[2]; ?>">
                </li>
                <li>
                    <label for="i-email"><?= \Framework\Localization\Localization::$lang[0]['Email']; ?></label>
                </li>
                <li>
                    <input name="email" class="i-1 t-i" id="i-email" type="text"
                           value="<?= $account->email; ?>">
                </li>
                <li>
                    <label for="i-pass"><?= \Framework\Localization\Localization::$lang[0]['Password']; ?></label>
                </li>
                <li>
                    <input name="pass" class="i-1 t-i" id="i-pass" type="password"
                           value="blank_password41?^A" disabled>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Reset']; ?>">
                </li>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
                </li>
            </ul>
        </form>
    </div>
</div>
