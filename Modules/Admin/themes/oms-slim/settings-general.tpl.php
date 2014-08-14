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
                </li>
                <li>
                    <input name="oname" class="i-1 t-ts" id="i-on" type="text"
                           value="<?= \Framework\Model\Model::$content['core:oname']; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:oname']; ?>
                    </i>
                </li>
                <li>
                    <label for="i-loc"><?= \Framework\Localization\Localization::$lang[1]['LAddress']; ?></label>
                </li>
                <li>
                    <input name="addrlocal" class="i-1 t-ip t-wp" id="i-loc" type="text"
                           value="<?= \Framework\Model\Model::$content['page:addr:local']; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:loc']; ?>
                    </i>
                </li>
                <li>
                    <label for="i-rem"><?= \Framework\Localization\Localization::$lang[1]['RAddress']; ?></label>
                </li>
                <li>
                    <input name="addrremote" class="i-1 t-ip t-wp" id="i-rem" type="text"
                           value="<?= \Framework\Model\Model::$content['page:addr:remote']; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:rem']; ?>
                    </i>
                </li>
                <li>
                    <label for="i-cache"><?= \Framework\Localization\Localization::$lang[1]['Cache']; ?></label>
                </li>
                <li>
                    <select name="cache" class="i-1" id="i-cache">
                        <option
                            value="0"<?= ($this->app->cache->type == 0 ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['None']; ?></option>
                        <option
                            value="1"<?= ($this->app->cache->type == 1 ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['File']; ?></option>
                        <option
                            value="2"<?= ($this->app->cache->type == 2 ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Memcache']; ?></option>
                    </select>
                </li>
                <li>
                    <label for="i-recache"><?= \Framework\Localization\Localization::$lang[1]['ReCache']; ?></label>
                </li>
                <li>
                    <input id="i-recache" type="checkbox" name="recache"
                           value="rc"><?= \Framework\Localization\Localization::$lang[1]['i:rc']; ?>
                </li>
                <li>
                    <label for="i-email"><?= \Framework\Localization\Localization::$lang[1]['EmailAdmin']; ?></label>
                </li>
                <li>
                    <input name="email" class="i-1 t-mail" id="i-email" type="text"
                           value="<?= $this->app->settings->config[1000000025]; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:mail']; ?>
                    </i>
                </li>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
                </li>
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
                </li>
                <li>
                    <select name="lang" class="i-1" id="i-lang">
                        <?php /* TODO: Add login msg and status */
                        foreach ($GLOBALS['LANGUAGES_ARRAY'] as $key => $val) {
                            echo '<option value="' . $key . '"' . ($key === \Framework\Model\Model::$content['core:language'] ? ' selected' : '') . '>' . $val . '</option>';
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label for="i-count"><?= \Framework\Localization\Localization::$lang[1]['Country']; ?></label>
                </li>
                <li>
                    <select name="count" class="i-1" id="i-count">
                        <?php
                        foreach ($GLOBALS['COUNTRIES_ARRAY'] as $key => $val) {
                            echo '<option value="' . $key . '"' . ($key === $this->app->settings->config[1000000019] ? ' selected' : '') . '>' . $val . '</option>';
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label for="i-time"><?= \Framework\Localization\Localization::$lang[1]['Time']; ?></label>
                </li>
                <li>
                    <select name="time" class="i-1" id="i-time">
                        <?php
                        $time = array('Pacific/Midway' => '(GMT-11:00) Midway Island', 'US/Samoa' => '(GMT-11:00) Samoa', 'US/Hawaii' => '(GMT-10:00) Hawaii', 'US/Alaska' => '(GMT-09:00) Alaska', 'US/Pacific' => '(GMT-08:00) Pacific Time (US &amp; Canada)', 'America/Tijuana' => '(GMT-08:00) Tijuana', 'US/Arizona' => '(GMT-07:00) Arizona', 'US/Mountain' => '(GMT-07:00) Mountain Time (US &amp; Canada)', 'America/Chihuahua' => '(GMT-07:00) Chihuahua', 'America/Mazatlan' => '(GMT-07:00) Mazatlan', 'America/Mexico_City' => '(GMT-06:00) Mexico City', 'America/Monterrey' => '(GMT-06:00) Monterrey', 'Canada/Saskatchewan' => '(GMT-06:00) Saskatchewan', 'US/Central' => '(GMT-06:00) Central Time (US &amp; Canada)', 'US/Eastern' => '(GMT-05:00) Eastern Time (US &amp; Canada)', 'US/East-Indiana' => '(GMT-05:00) Indiana (East)', 'America/Bogota' => '(GMT-05:00) Bogota', 'America/Lima' => '(GMT-05:00) Lima', 'America/Caracas' => '(GMT-04:30) Caracas', 'Canada/Atlantic' => '(GMT-04:00) Atlantic Time (Canada)', 'America/La_Paz' => '(GMT-04:00) La Paz', 'America/Santiago' => '(GMT-04:00) Santiago', 'Canada/Newfoundland' => '(GMT-03:30) Newfoundland', 'America/Buenos_Aires' => '(GMT-03:00) Buenos Aires', 'Greenland' => '(GMT-03:00) Greenland', 'Atlantic/Stanley' => '(GMT-02:00) Stanley', 'Atlantic/Azores' => '(GMT-01:00) Azores', 'Atlantic/Cape_Verde' => '(GMT-01:00) Cape Verde Is.', 'Africa/Casablanca' => '(GMT) Casablanca', 'Europe/Dublin' => '(GMT) Dublin', 'Europe/Lisbon' => '(GMT) Lisbon', 'Europe/London' => '(GMT) London', 'Africa/Monrovia' => '(GMT) Monrovia', 'Europe/Amsterdam' => '(GMT+01:00) Amsterdam', 'Europe/Belgrade' => '(GMT+01:00) Belgrade', 'Europe/Berlin' => '(GMT+01:00) Berlin', 'Europe/Bratislava' => '(GMT+01:00) Bratislava', 'Europe/Brussels' => '(GMT+01:00) Brussels', 'Europe/Budapest' => '(GMT+01:00) Budapest', 'Europe/Copenhagen' => '(GMT+01:00) Copenhagen', 'Europe/Ljubljana' => '(GMT+01:00) Ljubljana', 'Europe/Madrid' => '(GMT+01:00) Madrid', 'Europe/Paris' => '(GMT+01:00) Paris', 'Europe/Prague' => '(GMT+01:00) Prague', 'Europe/Rome' => '(GMT+01:00) Rome', 'Europe/Sarajevo' => '(GMT+01:00) Sarajevo', 'Europe/Skopje' => '(GMT+01:00) Skopje', 'Europe/Stockholm' => '(GMT+01:00) Stockholm', 'Europe/Vienna' => '(GMT+01:00) Vienna', 'Europe/Warsaw' => '(GMT+01:00) Warsaw', 'Europe/Zagreb' => '(GMT+01:00) Zagreb', 'Europe/Athens' => '(GMT+02:00) Athens', 'Europe/Bucharest' => '(GMT+02:00) Bucharest', 'Africa/Cairo' => '(GMT+02:00) Cairo', 'Africa/Harare' => '(GMT+02:00) Harare', 'Europe/Helsinki' => '(GMT+02:00) Helsinki', 'Europe/Istanbul' => '(GMT+02:00) Istanbul', 'Asia/Jerusalem' => '(GMT+02:00) Jerusalem', 'Europe/Kiev' => '(GMT+02:00) Kyiv', 'Europe/Minsk' => '(GMT+02:00) Minsk', 'Europe/Riga' => '(GMT+02:00) Riga', 'Europe/Sofia' => '(GMT+02:00) Sofia', 'Europe/Tallinn' => '(GMT+02:00) Tallinn', 'Europe/Vilnius' => '(GMT+02:00) Vilnius', 'Asia/Baghdad' => '(GMT+03:00) Baghdad', 'Asia/Kuwait' => '(GMT+03:00) Kuwait', 'Africa/Nairobi' => '(GMT+03:00) Nairobi', 'Asia/Riyadh' => '(GMT+03:00) Riyadh', 'Asia/Tehran' => '(GMT+03:30) Tehran', 'Europe/Moscow' => '(GMT+04:00) Moscow', 'Asia/Baku' => '(GMT+04:00) Baku', 'Europe/Volgograd' => '(GMT+04:00) Volgograd', 'Asia/Muscat' => '(GMT+04:00) Muscat', 'Asia/Tbilisi' => '(GMT+04:00) Tbilisi', 'Asia/Yerevan' => '(GMT+04:00) Yerevan', 'Asia/Kabul' => '(GMT+04:30) Kabul', 'Asia/Karachi' => '(GMT+05:00) Karachi', 'Asia/Tashkent' => '(GMT+05:00) Tashkent', 'Asia/Kolkata' => '(GMT+05:30) Kolkata', 'Asia/Kathmandu' => '(GMT+05:45) Kathmandu', 'Asia/Yekaterinburg' => '(GMT+06:00) Ekaterinburg', 'Asia/Almaty' => '(GMT+06:00) Almaty', 'Asia/Dhaka' => '(GMT+06:00) Dhaka', 'Asia/Novosibirsk' => '(GMT+07:00) Novosibirsk', 'Asia/Bangkok' => '(GMT+07:00) Bangkok', 'Asia/Jakarta' => '(GMT+07:00) Jakarta', 'Asia/Krasnoyarsk' => '(GMT+08:00) Krasnoyarsk', 'Asia/Chongqing' => '(GMT+08:00) Chongqing', 'Asia/Hong_Kong' => '(GMT+08:00) Hong Kong', 'Asia/Kuala_Lumpur' => '(GMT+08:00) Kuala Lumpur', 'Australia/Perth' => '(GMT+08:00) Perth', 'Asia/Singapore' => '(GMT+08:00) Singapore', 'Asia/Taipei' => '(GMT+08:00) Taipei', 'Asia/Ulaanbaatar' => '(GMT+08:00) Ulaan Bataar', 'Asia/Urumqi' => '(GMT+08:00) Urumqi', 'Asia/Irkutsk' => '(GMT+09:00) Irkutsk', 'Asia/Seoul' => '(GMT+09:00) Seoul', 'Asia/Tokyo' => '(GMT+09:00) Tokyo', 'Australia/Adelaide' => '(GMT+09:30) Adelaide', 'Australia/Darwin' => '(GMT+09:30) Darwin', 'Asia/Yakutsk' => '(GMT+10:00) Yakutsk', 'Australia/Brisbane' => '(GMT+10:00) Brisbane', 'Australia/Canberra' => '(GMT+10:00) Canberra', 'Pacific/Guam' => '(GMT+10:00) Guam', 'Australia/Hobart' => '(GMT+10:00) Hobart', 'Australia/Melbourne' => '(GMT+10:00) Melbourne', 'Pacific/Port_Moresby' => '(GMT+10:00) Port Moresby', 'Australia/Sydney' => '(GMT+10:00) Sydney', 'Asia/Vladivostok' => '(GMT+11:00) Vladivostok', 'Asia/Magadan' => '(GMT+12:00) Magadan', 'Pacific/Auckland' => '(GMT+12:00) Auckland', 'Pacific/Fiji' => '(GMT+12:00) Fiji',);

                        foreach ($GLOBALS['TIMEZONES_ARRAY'] as $key => $val) {
                            echo '<option value="' . $val . '"' . ($val === \Framework\Model\Model::$content['core:timezone'] ? ' selected' : '') . '>' . $val . '</option>';
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label for="i-timef"><?= \Framework\Localization\Localization::$lang[1]['Timeformat']; ?></label>
                </li>
                <li>
                    <input name="timeformat" class="i-1 t-timef" id="i-timef" type="text"
                           value="<?= \Framework\Model\Model::$content['core:timeformat']; ?>">
                    <i class="bt-1 p-3 vh">
                        <?= \Framework\Localization\Localization::$lang[1]['i:timef']; ?>
                    </i>
                </li>
                <li>
                    <label for="i-curr"><?= \Framework\Localization\Localization::$lang[1]['Currency']; ?></label>
                </li>
                <li>
                    <select name="curr" class="i-1" id="i-curr">
                        <?php
                        foreach ($GLOBALS['CURRENCIES_ARRAY'] as $key => $val) {
                            echo '<option value="' . $key . '"' . ($key === $this->app->settings->config[1000000023] ? ' selected' : '') . '>' . $val[0] . '</option>';
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
                </li>
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
                </li>
                <li>
                    <select name="uname" class="i-1" id="i-uname">
                        <option
                            value="1"<?= ($this->app->settings->config[1000000026] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Email']; ?></option>
                        <option
                            value="2"<?= ($this->app->settings->config[1000000026] === '2' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['ID']; ?></option>
                    </select>
                </li>
                <li>
                    <label for="i-pass"><?= \Framework\Localization\Localization::$lang[1]['Password']; ?></label>
                </li>
                <li>
                    <select name="pass" class="i-1" id="i-pass" multiple>
                        <option
                            value="1"<?= ($this->app->settings->config[1000000024] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Lowercase']; ?></option>
                        <option
                            value="2"<?= ($this->app->settings->config[1000000007] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Uppercase']; ?></option>
                        <option
                            value="3"<?= ($this->app->settings->config[1000000008] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Numeric']; ?></option>
                        <option
                            value="4"<?= ($this->app->settings->config[1000000006] === '1' ? ' selected' : ''); ?>><?= \Framework\Localization\Localization::$lang[1]['Specialchar']; ?></option>
                    </select>
                </li>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Submit']; ?>">
                </li>
            </ul>
        </form>
    </div>
</div>