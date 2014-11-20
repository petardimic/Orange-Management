<?php /** @var \Modules\Sales\Handler $this */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT, 1001602001]);
\Framework\Model\Model::generate_table_filter_view(); ?>


<div class="tabview">
<ul class="tab-links">
    <li class="active">
        <a href=".tab-1"><?= $this->app->user->localization->lang[16]['CoreData'] ?></a>
    <li>
        <a href=".tab-2"><?= $this->app->user->localization->lang[16]['Address'] ?></a>
    <li>
        <a href=".tab-3"><?= $this->app->user->localization->lang[16]['Terms'] ?></a>
    <li>
        <a href=".tab-4"><?= $this->app->user->localization->lang[16]['Discount'] ?></a>
</ul>

<div class="tab-content">
<div class="tab tab-1 active">
    <div class="b b-2 c1-8 c1" id="i1-8-2">
        <h1>
            <?= $this->app->user->localization->lang[16]['Account']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <form class="f-1">
                <ul class="l-1">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['Reference']; ?></label>
                    <li>
                        <input type="text">
                        <button><?= $this->app->user->localization->lang[0]['Find']; ?></button>
                    <li>
                        <label for="i-status"><?= $this->app->user->localization->lang[16]['Status']; ?></label>
                    <li>
                        <select name="status" id="i-status">
                            <option value="0">
                                <?= $this->app->user->localization->lang[16]['Active']; ?>
                            <option value="1">
                                <?= $this->app->user->localization->lang[16]['Inactive']; ?>
                        </select>
                    <li>
                        <label for="i-type"><?= $this->app->user->localization->lang[16]['Type']; ?></label>
                    <li>
                        <select name="type" id="i-type">
                            <option value="0">
                                <?= $this->app->user->localization->lang[16]['Single']; ?>
                            <option value="1">
                                <?= $this->app->user->localization->lang[16]['Group']; ?>
                        </select>
                    <li>
                        <label
                            for="i-active"><?= $this->app->user->localization->lang[16]['Activity']; ?></label>
                    <li>
                        <input name="active" class="i-1 t-i" id="i-active" type="text">
                    <li>
                </ul>
            </form>
        </div>
    </div>

    <div class="b b-2 c1-8 c1" id="i1-8-3">
        <h1>
            <?= $this->app->user->localization->lang[16]['Account']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <form class="f-1">
                <ul class="l-1">
                    <li>
                        <label
                            for="i-login"><?= $this->app->user->localization->lang[16]['Loginname']; ?></label>
                    <li>
                        <input name="login" class="i-1 t-i" id="i-login" type="text">
                    <li>
                        <label for="i-name1"><?= $this->app->user->localization->lang[16]['Name1']; ?></label>
                    <li>
                        <input name="name1" class="i-1 t-i" id="i-name1" type="text">
                    <li>
                        <label for="i-name2"><?= $this->app->user->localization->lang[16]['Name2']; ?></label>
                    <li>
                        <input name="name2" class="i-1 t-i" id="i-name2" type="text">
                    <li>
                        <label for="i-name3"><?= $this->app->user->localization->lang[16]['Name3']; ?></label>
                    <li>
                        <input name="name3" class="i-1 t-i" id="i-name3" type="text">
                    <li>
                        <label for="i-email"><?= $this->app->user->localization->lang[0]['Email']; ?></label>
                    <li>
                        <input name="email" class="i-1 t-i" id="i-email" type="text">
                    <li>
                        <label for="i-pass"><?= $this->app->user->localization->lang[0]['Password']; ?></label>
                    <li>
                        <input name="pass" class="i-1 t-i" id="i-pass" type="password">
                        <input type="button" value="<?= $this->app->user->localization->lang[0]['Create']; ?>">
                    <li>
                </ul>
            </form>
        </div>
    </div>
</div>
<div class="tab tab-2">
    <div class="b b-1 c16-1 c16" id="i16-1-1">
        <h1>
            <?= $this->app->user->localization->lang[16]['Address']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <form class="f-1">
                <ul class="l-1">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['Name']; ?></label>
                    <li>
                        <select></select>
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['IsDefault']; ?></label>
                    <li>
                        <input type="checkbox"><label
                            for="i-status"><?= $this->app->user->localization->lang[16]['IsDefault']; ?></label>
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['FAO']; ?></label>
                    <li>
                        <input type="text">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['Street']; ?></label>
                    <li>
                        <input type="text">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['ZipCode']; ?></label>
                    <li>
                        <input type="text">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['City']; ?></label>
                    <li>
                        <input type="text">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['Country']; ?></label>
                    <li>
                        <input type="text">
                    <li>
                        <input type="button" value="<?= $this->app->user->localization->lang[0]['Add']; ?>">
                </ul>
            </form>
        </div>
    </div>

    <div class="b b-3 c16-1 c16" id="i16-1-1">
        <h1>
            <?= $this->app->user->localization->lang[16]['Address']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">

        </div>
    </div>
</div>
<div class="tab tab-3">
    <div class="b b-1 c16-1 c16" id="i16-1-1">
        <h1>
            <?= $this->app->user->localization->lang[16]['Payment']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <form class="f-1">
                <ul class="l-1">

                </ul>
            </form>
        </div>
    </div>
</div>
<div class="tab tab-4">
    <div class="b b-1 c16-1 c16" id="i16-1-1">
        <h1>
            <?= $this->app->user->localization->lang[16]['Discount']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <form class="f-1">
                <ul class="l-1">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['Type']; ?></label>
                    <li>
                        <select></select>
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[0]['ID']; ?></label>
                    <li>
                        <input type="text">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['Discount']; ?></label>
                    <li>
                        <input type="text">
                    <li>
                        <label
                            for="i-status"><?= $this->app->user->localization->lang[16]['DiscountP']; ?></label>
                    <li>
                        <input type="text">
                    <li>
                        <input type="button" value="<?= $this->app->user->localization->lang[0]['Add']; ?>">
                </ul>
            </form>
        </div>
    </div>

    <div class="b b-3 c16-1 c16" id="i16-1-1">
        <h1>
            <?= $this->app->user->localization->lang[16]['Discount']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">

        </div>
    </div>
</div>
</div>
</div>

<div class="c-bar rT">
    <button><?= $this->app->user->localization->lang[0]['Create']; ?></button>
    <button><?= $this->app->user->localization->lang[0]['Cancel']; ?></button>
</div>
