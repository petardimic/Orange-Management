<?php
/**
 * @var \phpOMS\Views\View $this
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000301001);

$sidenav = new \Modules\Navigation\Views\NavigationView($this->l11n, $this->response, $this->request);
$sidenav->setTemplate('/Modules/Navigation/Theme/backend/mid-side');
$sidenav->setNav($this->getData('nav'));
$sidenav->setLanguage($this->l11n->language);
$sidenav->setParent(1000301001);
?>
<?= $nav->getOutput(); ?>
<div itemscope itemtype="http://schema.org/Person">
    <div class="b-7" id="i3-2-1">
        <div class="b-5" id="i3-2-4">
            <div class="bc-1">
                <img src="/Modules/Profile/Theme/backend/img/profile-default-small.jpg" itemprop="image">
            </div>
        </div>
        <?= $sidenav->getOutput(); ?>
    </div>
    <div class="b-6" id="i3-2-2">
        <div class="b b-2 c3-2 c3" id="i3-2-3">
            <h1>
                <?= $this->l11n->lang[3]['Profile']; ?>
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
            </h1>

            <div class="bc-1">
                <!-- @formatter:off -->
                <table class="tc-1">
                    <tr>
                        <th><?= $this->l11n->lang[3]['Name']; ?>
                        <td><span itemprop="familyName">Duck</span>, <span itemprop="givenName">Donald</span>
                    <tr>
                        <th><?= $this->l11n->lang[3]['Occupation']; ?>
                        <td itemprop="jobTitle">Sailor
                    <tr>
                        <th><?= $this->l11n->lang[3]['Birthday']; ?>
                        <td itemprop="birthDate">06.09.1934
                    <tr>
                        <th><?= $this->l11n->lang[3]['Ranks']; ?>
                        <td itemprop="memberOf">Gosling
                    <tr>
                        <th><?= $this->l11n->lang[3]['Email']; ?>
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
                        <th><?= $this->l11n->lang[3]['Phone']; ?>
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
                        <th><?= $this->l11n->lang[3]['Registered']; ?>
                        <td>09.06.1934
                    <tr>
                        <th><?= $this->l11n->lang[3]['LastLogin']; ?>
                        <td>01.04.2015
                    <tr>
                        <th><?= $this->l11n->lang[3]['Status']; ?>
                        <td><span class="green">Active</span>
                </table>
                <!-- @formatter:on -->
            </div>
        </div>
    </div>
</div>