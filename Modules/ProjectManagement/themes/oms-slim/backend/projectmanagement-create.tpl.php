<?php /** @var \Modules\ProjectManagement\Handler $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1001701001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="tabview">
    <!-- @formatter:off -->
    <ul class="tab-links">
        <li class="active"><a href=".tab-1"><?= $this->app->user->localization->lang[17]['CoreData'] ?></a>
        <li><a href=".tab-2"><?= $this->app->user->localization->lang[17]['Milestone'] ?></a>
        <li><a href=".tab-3"><?= $this->app->user->localization->lang[17]['Elements'] ?></a>
    </ul>
    <!-- @formatter:on -->

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-2 c17-2 c17" id="i17-2-1">
                <h1>
                    <?= $this->app->user->localization->lang[17]['ProjectManagement']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->user->localization->lang[17]['Title']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->localization->lang[17]['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->user->localization->lang[17]['Start']; ?></label>
                        <li><input type="date">
                        <li><label><?= $this->app->user->localization->lang[17]['End']; ?></label>
                        <li><input type="date">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>

            <div class="b b-2 c17-2 c17" id="i17-2-2">
                <h1>
                    <?= $this->app->user->localization->lang[17]['Permissions']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->user->localization->lang[17]['Group']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->user->localization->lang[0]['Add']; ?></button>
                        <li><label><?= $this->app->user->localization->lang[17]['User']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->user->localization->lang[0]['Add']; ?></button>
                        <li><label><?= $this->app->user->localization->lang[17]['Manager']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->user->localization->lang[0]['Add']; ?></button>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>
        </div>
        <div class="tab tab-2">
            <div class="b b-2 c17-2 c17" id="i17-2-2">
                <h1>
                    <?= $this->app->user->localization->lang[17]['Milestone']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->user->localization->lang[0]['ID']; ?></label>
                        <li><input type="text" disabled>
                        <li><label><?= $this->app->user->localization->lang[17]['Name']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->localization->lang[17]['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->user->localization->lang[17]['Start']; ?></label>
                        <li><input type="date">
                        <li><label><?= $this->app->user->localization->lang[17]['End']; ?></label>
                        <li><input type="date">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                    <button><?= $this->app->user->localization->lang[0]['Add']; ?></button>
                </div>
            </div>
        </div>
        <div class="tab tab-3">
            <div class="b b-2 c17-2 c17" id="i17-2-2">
                <h1>
                    <?= $this->app->user->localization->lang[17]['Elements']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->user->localization->lang[0]['ID']; ?></label>
                        <li><input type="text" disabled>
                        <li><label><?= $this->app->user->localization->lang[17]['Milestone']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->localization->lang[17]['Depending']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->localization->lang[17]['Type']; ?></label>
                        <li>
                            <select>
                                <option><?= $this->app->user->localization->lang[17]['Task']; ?>
                                <option><?= $this->app->user->localization->lang[17]['Calendar']; ?>
                            </select>
                        <li><label><?= $this->app->user->localization->lang[17]['Title']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->localization->lang[17]['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->user->localization->lang[17]['Start']; ?></label>
                        <li><input type="date">
                        <li><label><?= $this->app->user->localization->lang[17]['End']; ?></label>
                        <li><input type="date">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                    <button><?= $this->app->user->localization->lang[0]['Add']; ?></button>
                </div>
            </div>

            <div class="b b-2 c17-2 c17" id="i17-2-2">
                <h1>
                    <?= $this->app->user->localization->lang[17]['Permissions']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->user->localization->lang[17]['Group']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->user->localization->lang[0]['Add']; ?></button>
                        <li><label><?= $this->app->user->localization->lang[17]['User']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->user->localization->lang[0]['Add']; ?></button>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="b b-5 c17-2 c17" id="i17-2-2">
    <h1>
        <?= $this->app->user->localization->lang[17]['Project']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
    </div>
</div>

<div class="c-bar rT">
    <button><?= $this->app->user->localization->lang[0]['Create']; ?></button>
    <button><?= $this->app->user->localization->lang[0]['Cancel']; ?></button>
</div>
