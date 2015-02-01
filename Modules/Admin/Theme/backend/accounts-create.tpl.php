<?php /** @var \Modules\Admin\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000104001]);
?>

<div class="b b-2 c1-8 c1" id="i1-8-2">
    <h1>
        <?= $this->app->user->getL11n()->lang[1]['Account']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-status"><?= $this->app->user->getL11n()->lang[1]['Status']; ?></label>
                <li>
                    <select name="status" id="i-status">
                        <option value="0">
                            <?= $this->app->user->getL11n()->lang[1]['Active']; ?>
                        <option value="1">
                            <?= $this->app->user->getL11n()->lang[1]['Inactive']; ?>
                    </select>
                <li>
                    <label for="i-type"><?= $this->app->user->getL11n()->lang[1]['Type']; ?></label>
                <li>
                    <select name="type" id="i-type">
                        <option value="0">
                            <?= $this->app->user->getL11n()->lang[1]['Single']; ?>
                        <option value="1">
                            <?= $this->app->user->getL11n()->lang[1]['Group']; ?>
                    </select>
                <li>
                    <label for="i-active"><?= $this->app->user->getL11n()->lang[1]['Activity']; ?></label>
                <li>
                    <input name="active" class="i-1 t-i" id="i-active" type="text">
                <li>
                    <label for="i-created"><?= $this->app->user->getL11n()->lang[1]['Created']; ?></label>
                <li>
                    <input name="created" class="i-1 t-i" id="i-created" type="text">
                <li>
            </ul>
        </form>
    </div>
</div>

<div class="b b-2 c1-8 c1" id="i1-8-3">
    <h1>
        <?= $this->app->user->getL11n()->lang[1]['Account']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-login"><?= $this->app->user->getL11n()->lang[1]['Loginname']; ?></label>
                <li>
                    <input name="login" class="i-1 t-i" id="i-login" type="text">
                <li>
                    <label for="i-name1"><?= $this->app->user->getL11n()->lang[1]['Name1']; ?></label>
                <li>
                    <input name="name1" class="i-1 t-i" id="i-name1" type="text">
                <li>
                    <label for="i-name2"><?= $this->app->user->getL11n()->lang[1]['Name2']; ?></label>
                <li>
                    <input name="name2" class="i-1 t-i" id="i-name2" type="text">
                <li>
                    <label for="i-name3"><?= $this->app->user->getL11n()->lang[1]['Name3']; ?></label>
                <li>
                    <input name="name3" class="i-1 t-i" id="i-name3" type="text">
                <li>
                    <label for="i-email"><?= $this->app->user->getL11n()->lang[0]['Email']; ?></label>
                <li>
                    <input name="email" class="i-1 t-i" id="i-email" type="text">
                <li>
                    <label for="i-pass"><?= $this->app->user->getL11n()->lang[0]['Password']; ?></label>
                <li>
                    <input name="pass" class="i-1 t-i" id="i-pass" type="password"> <input type="button"
                                                                                           value="<?= $this->app->user->getL11n()->lang[0]['Create']; ?>">
                <li>
            </ul>
        </form>
    </div>
</div>

<div class="c-bar rT">
    <button><?= $this->app->user->getL11n()->lang[0]['Create']; ?></button>
    <button><?= $this->app->user->getL11n()->lang[0]['Cancel']; ?></button>
</div>

