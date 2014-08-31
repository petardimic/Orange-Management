<div class="b b-1 c3-2 c3" id="i3-2-1">
    <h1>
        <?= \Framework\Localization\Localization::$lang[3]['Account']; /** @var \Modules\Admin\Admin $this */ ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <?php $account = \Framework\DataStorage\Database\Objects\User\User::getInstance((int)$this->app->request->uri['id']); ?>
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-id"><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                <li>
                    <input name="id" class="i-1 t-i" id="i-id" type="text"
                           value="<?= (int)$this->app->request->uri['id']; ?>" disabled>
                <li>
                    <label for="i-status"><?= \Framework\Localization\Localization::$lang[3]['Status']; ?></label>
                <li>
                    <select name="status" id="i-status">
                        <option value="0"<?= (0 === $account->status ? 'selected' : ''); ?>>
                            <?= \Framework\Localization\Localization::$lang[3]['Active']; ?>
                        <option value="1"<?= (1 === $account->status ? 'selected' : ''); ?>>
                            <?= \Framework\Localization\Localization::$lang[3]['Inactive']; ?>
                    </select>
                <li>
                    <label for="i-type"><?= \Framework\Localization\Localization::$lang[3]['Type']; ?></label>
                <li>
                    <select name="type" id="i-type">
                        <option value="0"<?= (0 === $account->type ? 'selected' : ''); ?>>
                            <?= \Framework\Localization\Localization::$lang[3]['Single']; ?>
                        <option value="1"<?= (1 === $account->type ? 'selected' : ''); ?>>
                            <?= \Framework\Localization\Localization::$lang[3]['Group']; ?>
                    </select>
                <li>
                    <label for="i-active"><?= \Framework\Localization\Localization::$lang[3]['Activity']; ?></label>
                <li>
                    <input name="active" class="i-1 t-i" id="i-active" type="text"
                           value="<?= $account->last_activity; ?>" disabled>
                <li>
                    <label for="i-created"><?= \Framework\Localization\Localization::$lang[3]['Created']; ?></label>
                <li>
                    <input name="created" class="i-1 t-i" id="i-created" type="text"
                           value="<?= $account->created; ?>" disabled>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
            </ul>
        </form>
    </div>
</div>

<div class="b b-1 c3-2 c3" id="i3-2-2">
    <h1>
        <?php
        echo \Framework\Localization\Localization::$lang[3]['Profile']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-login"><?= \Framework\Localization\Localization::$lang[3]['Loginname']; ?></label>
                <li>
                    <input name="login" class="i-1 t-i" id="i-login" type="text"
                           value="<?= $account->login_name; ?>">
                <li>
                    <label for="i-name1"><?= \Framework\Localization\Localization::$lang[3]['Name1']; ?></label>
                <li>
                    <input name="name1" class="i-1 t-i" id="i-name1" type="text"
                           value="<?= $account->name[0]; ?>">
                <li>
                    <label for="i-name2"><?= \Framework\Localization\Localization::$lang[3]['Name2']; ?></label>
                <li>
                    <input name="name2" class="i-1 t-i" id="i-name2" type="text"
                           value="<?= $account->name[1]; ?>">
                <li>
                    <label for="i-name3"><?= \Framework\Localization\Localization::$lang[3]['Name3']; ?></label>
                <li>
                    <input name="name3" class="i-1 t-i" id="i-name3" type="text"
                           value="<?= $account->name[2]; ?>">
                <li>
                    <label for="i-email"><?= \Framework\Localization\Localization::$lang[0]['Email']; ?></label>
                <li>
                    <input name="email" class="i-1 t-i" id="i-email" type="text"
                           value="<?= $account->email; ?>">
                <li>
                    <label for="i-pass"><?= \Framework\Localization\Localization::$lang[0]['Password']; ?></label>
                <li>
                    <input name="pass" class="i-1 t-i" id="i-pass" type="password"
                           value="blank_password41?^A" disabled>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Reset']; ?>">
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
            </ul>
        </form>
    </div>
</div>
