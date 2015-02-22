<?php
/**
 * @var \phpOMS\Views\ViewAbstract $this
 */
/*
* Navigation
*/
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1001101001);
?>
<?= $nav->getOutput(); ?>

<div class="b b-4 c7-1 c7" id="i7-1-1">
    <h1><?= $this->l11n->lang[11]['Task']; ?></h1>

    <div class="bc-1">
        <!-- @formatter:off -->
        <ul class="l-1">
            <li><lable><?= $this->l11n->lang[11]['Receiver']; ?></lable>
            <li><input type="text">
            <li><lable><?= $this->l11n->lang[11]['Interval']; ?></lable>
            <li><select>
                <option value="0" selected><?= $this->l11n->lang[11]['All']; ?>
                <option value="1"><?= $this->l11n->lang[11]['Today']; ?>
                <option value="2"><?= $this->l11n->lang[11]['Week']; ?>
                <option value="3"><?= $this->l11n->lang[11]['Month']; ?>
                <option value="4"><?= $this->l11n->lang[11]['Year']; ?>
            </select>
            <li><button><?= $this->l11n->lang[0]['Submit']; ?></button>
        </ul>
        <!-- @formatter:on -->
    </div>
</div>

<!-- Analyse how many tasks that a user created got finished in time in order to see if he/she creates realistic estimates -->
<div class="b b-4 c7-1 c7" id="i7-1-1">
    <h1><?= $this->l11n->lang[11]['Task']; ?></h1>

    <div class="bc-1">
        <!-- @formatter:off -->
        <table class="tc-1">
            <tr>
                <th><label><?= $this->l11n->lang[11]['Received']; ?></label>
                    <td>0
                <tr>
                    <th><label><?= $this->l11n->lang[11]['Created']; ?></label>
                    <td>0
                <tr>
                    <th><label><?= $this->l11n->lang[11]['Forwarded']; ?></label>
                    <td>0
                <tr>
                    <th><label><?= $this->l11n->lang[11]['AverageAmount']; ?></label>
                    <td>0
                <tr>
                    <th><label><?= $this->l11n->lang[11]['AverageProcessTime']; ?></label>
                    <td>0 Min.
                <tr>
                    <th><label><?= $this->l11n->lang[11]['InTime']; ?></label>
                    <td>0.00%
        </table>
        <!-- @formatter:on -->
    </div>
</div>