<?php /** @var \Modules\Profile\Handler $this */
$account = \Framework\Object\User\User::getInstance((int) $this->app->request->request['id'], $this->app); ?>
<div itemscope itemtype="http://schema.org/Person">
    <div class="b-7" id="i3-2-1">
        <div class="b-5" id="i3-2-4">
            <div class="bc-1">
                <img src="/Modules/Profile/themes/oms-slim/backend/img/profile-default-small.jpg" itemprop="image">
            </div>
        </div>
        <?php /** @noinspection PhpUndefinedMethodInspection */
        \Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT_SIDE,
                                                                         1000301001]); ?>
    </div>
    <div class="b-6" id="i3-2-2">
        <div class="b b-2 c3-2 c3" id="i3-2-3">
            <h1>
                <?= $this->app->user->localization->lang[3]['Profile']; /** @var \Modules\Profile\Handler $this */ ?>
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
            </h1>

            <div class="bc-1">
                <!-- @formatter:off -->
                <table class="tc-1">
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['Name']; ?>
                        <td><span itemprop="familyName">Duck</span>, <span itemprop="givenName">Donald</span>
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['Occupation']; ?>
                        <td itemprop="jobTitle">Sailor
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['Birthday']; ?>
                        <td itemprop="birthDate">06.09.1934
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['Ranks']; ?>
                        <td itemprop="memberOf">Gosling
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['Email']; ?>
                        <td itemprop="email"><a href="mailto:>donald.duck@email.com<">donald.duck[at]email.com</a>
                    <tr>
                        <th>Address
                        <td>
                    <tr>
                        <th class="vT">Private
                        <td itemprop="address">SMALLSYS INC<br>795 E DRAGRAM<br>TUCSON AZ 85705<br>USA
                    <tr>
                        <th class="vT">Work
                        <td itemprop="address">SMALLSYS INC<br>795 E DRAGRAM<br>TUCSON AZ 85705<br>USA
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['Phone']; ?>
                        <td>
                    <tr>
                        <th>Private
                        <td itemprop="telephone">+01 12345-4567
                    <tr>
                        <th>Mobile
                        <td itemprop="telephone">+01 12345-4567
                    <tr>
                        <th>Work
                        <td itemprop="telephone">+01 12345-4567
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['Registered']; ?>
                        <td>09.06.1934
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['LastLogin']; ?>
                        <td>01.04.2015
                    <tr>
                        <th><?= $this->app->user->localization->lang[3]['Status']; ?>
                        <td><span class="green">Active</span>
                </table>
                <!-- @formatter:on -->
            </div>
        </div>
    </div>
</div>