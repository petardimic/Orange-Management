<?php $locals = \Framework\Localization\Localization::get_locals(); ?>
<div class="b b-1 c1-1 c1" id="i1-1-1">
    <h1>
        <?php
        /** @var \Modules\Admin\Admin $this */
        echo \Framework\Localization\Localization::$lang[1]['Page']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <i class="bt-1 p-3 vh i-empty"><?= \Framework\Localization\Localization::$lang[0]['e:empty']; ?></i>
            <ul class="l-1">
                <li>
                    <label for="i-on"><?= \Framework\Localization\Localization::$lang[1]['OName']; ?></label>
                <li>
                    <input name="oname" class="i-1 t-ts" id="i-on" type="text"
                           value="<?= \Framework\Model\Model::$content['core:oname']; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:oname']; ?>
                    </i>
                <li>
                    <label for="i-loc"><?= \Framework\Localization\Localization::$lang[1]['LAddress']; ?></label>
                <li>
                    <input name="addrlocal" class="i-1 t-ip t-wp" id="i-loc" type="text"
                           value="<?= \Framework\Model\Model::$content['page:addr:local']; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:loc']; ?>
                    </i>
                <li>
                    <label for="i-rem"><?= \Framework\Localization\Localization::$lang[1]['RAddress']; ?></label>
                <li>
                    <input name="addrremote" class="i-1 t-ip t-wp" id="i-rem" type="text"
                           value="<?= \Framework\Model\Model::$content['page:addr:remote']; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:rem']; ?>
                    </i>
                <li>
                    <label for="i-cache"><?= \Framework\Localization\Localization::$lang[1]['Cache']; ?></label>
                <li>
                    <select name="cache" class="i-1" id="i-cache">
                        <option
                            value="0"<?= ($this->app->cache->type == 0 ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['None']; ?></option>
                        <option
                            value="1"<?= ($this->app->cache->type == 1 ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['File']; ?></option>
                        <option
                            value="2"<?= ($this->app->cache->type == 2 ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Memcache']; ?></option>
                    </select>
                <li>
                    <label for="i-recache"><?= \Framework\Localization\Localization::$lang[1]['ReCache']; ?></label>
                <li>
                    <input id="i-recache" type="checkbox" name="recache"
                           value="rc">
                    <label><?= \Framework\Localization\Localization::$lang[1]['i:rc']; ?></label>
                <li>
                    <label for="i-email"><?= \Framework\Localization\Localization::$lang[1]['EmailAdmin']; ?></label>
                <li>
                    <input name="email" class="i-1 t-mail" id="i-email" type="text"
                           value="<?= $this->app->settings->config[1000000025]; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:mail']; ?>
                    </i>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
            </ul>
        </form>
    </div>
</div>

<div class="b b-1 c1-1 c1" id="i1-1-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Localization']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <i class="bt-1 p-3 vh i-empty"><?= \Framework\Localization\Localization::$lang[0]['e:empty']; ?></i>
            <ul class="l-1">
                <li>
                    <label for="i-lang"><?= \Framework\Localization\Localization::$lang[1]['Language']; ?></label>
                <li>
                    <select name="lang" class="i-1" id="i-lang">
                        <?php /* TODO: Add login msg and status */
                        foreach ($locals['LANGUAGES_ARRAY'] as $key => $val) {
                            echo '<option value="' . $key . '"' . ($key === $this->app->settings->config[1000000020] ? ' selected' : '') . '>' . $val;
                        }
                        ?>
                    </select>
                <li>
                    <label for="i-count"><?= \Framework\Localization\Localization::$lang[1]['Country']; ?></label>
                <li>
                    <select name="count" class="i-1" id="i-count">
                        <?php
                        foreach ($locals['COUNTRIES_ARRAY'] as $key => $val) {
                            echo '<option value="' . $key . '"' . ($key === $this->app->settings->config[1000000019] ? ' selected' : '') . '>' . $val;
                        }
                        ?>
                    </select>
                <li>
                    <label for="i-time"><?= \Framework\Localization\Localization::$lang[1]['Time']; ?></label>
                <li>
                    <select name="time" class="i-1" id="i-time">
                        <?php
                        foreach ($locals['TIMEZONES_ARRAY'] as $key => $val) {
                            echo '<option value="' . $val . '"' . ($val === $this->app->settings->config[1000000021] ? ' selected' : '') . '>' . $val;
                        }
                        ?>
                    </select>
                <li>
                    <label for="i-timef"><?= \Framework\Localization\Localization::$lang[1]['Timeformat']; ?></label>
                <li>
                    <input name="timeformat" class="i-1 t-timef" id="i-timef" type="text"
                           value="<?= $this->app->settings->config[1000000022] ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:timef']; ?>
                    </i>
                <li>
                    <label for="i-curr"><?= \Framework\Localization\Localization::$lang[1]['Currency']; ?></label>
                <li>
                    <select name="curr" class="i-1" id="i-curr">
                        <?php
                        foreach ($locals['CURRENCIES_ARRAY'] as $key => $val) {
                            echo '<option value="' . $key . '"' . ($key === $this->app->settings->config[1000000023] ? ' selected' : '') . '>' . $val[0];
                        }
                        ?>
                    </select>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
            </ul>
        </form>
    </div>
</div>

<div class="b b-1 c1-1 c1" id="i1-1-3">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Accounts']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-uname"><?= \Framework\Localization\Localization::$lang[1]['Loginname']; ?></label>
                <li>
                    <select name="uname" class="i-1" id="i-uname">
                        <option
                            value="1"<?= ($this->app->settings->config[1000000026] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Email']; ?>
                        <option
                            value="2"<?= ($this->app->settings->config[1000000026] === '2' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['ID']; ?>
                    </select>
                <li>
                    <label for="i-pass"><?= \Framework\Localization\Localization::$lang[1]['Password']; ?></label>
                <li>
                    <select name="pass" class="i-1" id="i-pass" multiple>
                        <option
                            value="1"<?= ($this->app->settings->config[1000000024] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Lowercase']; ?>
                        <option
                            value="2"<?= ($this->app->settings->config[1000000007] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Uppercase']; ?>
                        <option
                            value="3"<?= ($this->app->settings->config[1000000008] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Numeric']; ?>
                        <option
                            value="4"<?= ($this->app->settings->config[1000000006] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Specialchar']; ?>
                    </select>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
            </ul>
        </form>
    </div>
</div>