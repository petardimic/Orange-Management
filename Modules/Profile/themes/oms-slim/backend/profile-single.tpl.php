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
        <div class="b b-2 c3-2 c3" id="i3-2-3">
            <h1>
                <?= \Framework\Localization\Localization::$lang[3]['Profile']; /** @var \Modules\Profile\Handler $this */ ?>
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
            </h1>

            <div class="bc-1">
                 <!-- @formatter:off -->
                <table class="tc-1">
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['Name']; ?>
                        <td><span itemprop="familyName">Duck</span>, <span itemprop="givenName">Donald</span>
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['Occupation']; ?>
                        <td itemprop="jobTitle">Test
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['Birthday']; ?>
                        <td itemprop="birthDate">Test
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['Ranks']; ?>
                        <td itemprop="memberOf">Test
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['Email']; ?>
                        <td itemprop="email">Test
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['Phone']; ?>
                        <td itemprop="telephone">Test
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['Registered']; ?>
                        <td>Test
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['LastLogin']; ?>
                        <td>Test
                    <tr>
                        <th><?= \Framework\Localization\Localization::$lang[3]['Status']; ?>
                        <td>Test
                </table>
                <!-- @formatter:on -->
            </div>
        </div>
    </div>
</div>