<?php $account = \Framework\DataStorage\Database\Objects\User\User::getInstance((int)$this->app->request->uri['id'], $this->app); ?>
<div itemscope itemtype="http://schema.org/Person">
    <div class="b-7" id="i3-2-1">
        <div class="b-5" id="i3-2-4">
            <div class="bc-1">
                <img src="/Modules/Profile/themes/oms-slim/backend/img/profile-default-small.jpg" itemprop="image">
            </div>
        </div>
        <div class="b b-5 c3-2 c3" id="i3-2-5">
            <h2>
                <?= \Framework\Localization\Localization::$lang[3]['Profile']; ?>
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
            </h2>

            <div class="bc-1">
                <ul class="l-1">
                </ul>
            </div>
        </div>
    </div>
    <div class="b-6" id="i3-2-2">
        <div class="b b-5 c3-2 c3" id="i3-2-3">
            <h1>
                <?= \Framework\Localization\Localization::$lang[3]['Profile']; /** @var \Modules\Profile\Profile $this */ ?>
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
            </h1>

            <div class="bc-1">
                <ul class="l-2">
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Name']; ?>
                    <li><span itemprop="familyName">Duck</span>, <span itemprop="givenName">Donald</span>
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Occupation']; ?>
                    <li itemprop="jobTitle">Test
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Birthday']; ?>
                    <li itemprop="birthDate">Test
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Ranks']; ?>
                    <li itemprop="memberOf">Test
                </ul>
            </div>
        </div>
        <div class="b b-5 c3-2 c3" id="i3-2-4">
            <h1>
                <?= \Framework\Localization\Localization::$lang[3]['ContactInformation']; ?>
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
            </h1>

            <div class="bc-1">
                <ul class="l-2">
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Email']; ?>
                    <li itemprop="email">Test
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Phone']; ?>
                    <li itemprop="telephone">Test
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Skype']; ?>
                    <li itemprop="telephone">Test
                </ul>
            </div>
        </div>
        <div class="b b-5 c3-2 c3" id="i3-2-5">
            <h1>
                <?= \Framework\Localization\Localization::$lang[3]['Community']; ?>
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
            </h1>

            <div class="bc-1">
                <ul class="l-2">
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Registered']; ?>
                    <li>Test
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['LastLogin']; ?>
                    <li>Test
                    <li>
                        <?= \Framework\Localization\Localization::$lang[3]['Status']; ?>
                    <li>Test
                </ul>
            </div>
        </div>
    </div>
</div>