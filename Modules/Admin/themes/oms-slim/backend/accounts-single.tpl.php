<?php /** @var \Modules\Admin\Handler $this */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT, 1000104300]);
?>

<div class="b b-1 c1-3 c1" id="i1-3-1">
    <h1>
        <?= $this->app->user->localization->lang[1]['Account']; /** @var \Modules\Admin\Handler $this */ ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <?php $account = \Framework\DataStorage\Database\Objects\User\User::getInstance((int)$this->app->request->request['id'], $this->app); ?>
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-id"><?= $this->app->user->localization->lang[0]['ID']; ?></label>
                <li>
                    <input name="id" class="i-1 t-i" id="i-id" type="text"
                           value="<?= (int)$this->app->request->request['id']; ?>" disabled>
                <li>
                    <label for="i-status"><?= $this->app->user->localization->lang[1]['Status']; ?></label>
                <li>
                    <select name="status" id="i-status">
                        <option value="0"<?= (0 === $account->status ? 'selected' : ''); ?>>
                            <?= $this->app->user->localization->lang[1]['Active']; ?>
                        </option>
                        <option value="1"<?= (1 === $account->status ? 'selected' : ''); ?>>
                            <?= $this->app->user->localization->lang[1]['Inactive']; ?>
                        </option>
                    </select>
                <li>
                    <label for="i-type"><?= $this->app->user->localization->lang[1]['Type']; ?></label>
                <li>
                    <select name="type" id="i-type">
                        <option value="0"<?= (0 === $account->type ? 'selected' : ''); ?>>
                            <?= $this->app->user->localization->lang[1]['Single']; ?>
                        </option>
                        <option value="1"<?= (1 === $account->type ? 'selected' : ''); ?>>
                            <?= $this->app->user->localization->lang[1]['Group']; ?>
                        </option>
                    </select>
                <li>
                    <label for="i-active"><?= $this->app->user->localization->lang[1]['Activity']; ?></label>
                <li>
                    <input name="active" class="i-1 t-i" id="i-active" type="text"
                           value="<?= $account->last_activity; ?>" disabled>
                <li>
                    <label for="i-created"><?= $this->app->user->localization->lang[1]['Created']; ?></label>
                <li>
                    <input name="created" class="i-1 t-i" id="i-created" type="text"
                           value="<?= $account->created; ?>" disabled>
                <li>
                    <input type="button" value="<?= $this->app->user->localization->lang[0]['Submit']; ?>">
            </ul>
        </form>
    </div>
</div>

<div class="b b-1 c1-3 c1" id="i1-3-2">
    <h1>
        <?php
        echo $this->app->user->localization->lang[1]['Profile']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-login"><?= $this->app->user->localization->lang[1]['Loginname']; ?></label>
                <li>
                    <input name="login" class="i-1 t-i" id="i-login" type="text"
                           value="<?= $account->login_name; ?>">
                <li>
                    <label for="i-name1"><?= $this->app->user->localization->lang[1]['Name1']; ?></label>
                <li>
                    <input name="name1" class="i-1 t-i" id="i-name1" type="text"
                           value="<?= $account->name[0]; ?>">
                <li>
                    <label for="i-name2"><?= $this->app->user->localization->lang[1]['Name2']; ?></label>
                <li>
                    <input name="name2" class="i-1 t-i" id="i-name2" type="text"
                           value="<?= $account->name[1]; ?>">
                <li>
                    <label for="i-name3"><?= $this->app->user->localization->lang[1]['Name3']; ?></label>
                <li>
                    <input name="name3" class="i-1 t-i" id="i-name3" type="text"
                           value="<?= $account->name[2]; ?>">
                <li>
                    <label for="i-email"><?= $this->app->user->localization->lang[0]['Email']; ?></label>
                <li>
                    <input name="email" class="i-1 t-i" id="i-email" type="text"
                           value="<?= $account->email; ?>">
                <li>
                    <label for="i-pass"><?= $this->app->user->localization->lang[0]['Password']; ?></label>
                <li>
                    <input name="pass" class="i-1 t-i" id="i-pass" type="password"
                           value="blank_password41?^A" disabled>
                    <input type="button" value="<?= $this->app->user->localization->lang[0]['Reset']; ?>">
                <li>
                    <input type="button" value="<?= $this->app->user->localization->lang[0]['Submit']; ?>">
            </ul>
        </form>
    </div>
</div>
