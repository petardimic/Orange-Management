<?php /** @var \Modules\Surveys\Handler $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1000801001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="tabview">
    <ul class="tab-links">
        <li class="active">
            <a href=".tab-1"><?= \Framework\Localization\Localization::$lang[8]['CoreData'] ?></a>
        <li>
            <a href=".tab-2"><?= \Framework\Localization\Localization::$lang[8]['Section'] ?></a>
        <li>
            <a href=".tab-3"><?= \Framework\Localization\Localization::$lang[8]['Question'] ?></a>
        <li>
            <a href=".tab-4"><?= \Framework\Localization\Localization::$lang[8]['Answer'] ?></a>
    </ul>

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[8]['Survey']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <ul class="l-1">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Title']; ?></label>
                        <li>
                            <input type="text">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Description']; ?></label>
                        <li>
                            <textarea></textarea>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Start']; ?></label>
                        <li>
                            <input type="date">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['End']; ?></label>
                        <li>
                            <input type="date">
                        <li>
                    </ul>
                </div>
            </div>

            <div class="b b-2 c8-2 c8" id="i8-2-2">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[8]['Permissions']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <ul class="l-1">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Group']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['User']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Result']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab tab-2">
            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[8]['Section']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <ul class="l-1">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                        <li>
                            <input type="text" disabled>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Title']; ?></label>
                        <li>
                            <input type="text">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Description']; ?></label>
                        <li>
                            <textarea></textarea>
                        <li>
                    </ul>
                    <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
                </div>
            </div>
        </div>
        <div class="tab tab-3">
            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[8]['Question']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <ul class="l-1">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                        <li>
                            <input type="text" disabled>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Question']; ?></label>
                        <li>
                            <input type="text">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Description']; ?></label>
                        <li>
                            <textarea></textarea>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Section']; ?></label>
                        <li>
                            <input type="text">
                        <li>
                    </ul>
                    <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
                </div>
            </div>
        </div>
        <div class="tab tab-4">
            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[8]['Answer']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <ul class="l-1">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                        <li>
                            <input type="text" disabled>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Type']; ?></label>
                        <li>
                            <select>
                                <option selected><?= \Framework\Localization\Localization::$lang[8]['Radio']; ?>
                                <option><?= \Framework\Localization\Localization::$lang[8]['Checkbox']; ?>
                                <option><?= \Framework\Localization\Localization::$lang[8]['Dropdown']; ?>
                                <option><?= \Framework\Localization\Localization::$lang[8]['Text']; ?>
                                <option><?= \Framework\Localization\Localization::$lang[8]['Number']; ?>
                                <option><?= \Framework\Localization\Localization::$lang[8]['Date']; ?>
                            </select>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Answer']; ?></label>
                        <li>
                            <input type="text">
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[8]['Reference']; ?></label>
                        <li>
                            <select>
                                <option selected><?= \Framework\Localization\Localization::$lang[8]['Question']; ?>
                                <option><?= \Framework\Localization\Localization::$lang[8]['Section']; ?>
                            </select>
                        <li>
                            <label><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                        <li>
                            <input type="text">
                        <li>
                    </ul>
                    <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
                </div>
            </div>

            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[8]['Additional']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <ul class="l-1">
                        <li>

                        <li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="b b-5 c8-2 c8" id="i8-2-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[8]['Survey']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
    </div>
</div>

<div class="c-bar rT">
    <button><?= \Framework\Localization\Localization::$lang[0]['Create']; ?></button>
    <button><?= \Framework\Localization\Localization::$lang[0]['Cancel']; ?></button>
</div>
