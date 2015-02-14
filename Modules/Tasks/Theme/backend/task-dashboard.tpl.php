<?php
/**
 * @var \phpOMS\Views\ViewAbstract $this
 */

/*
 * UI Logic
 */
$tasksList = new \Web\Views\Lists\ListView($this->l11n);
$headerView = new \Web\Views\Lists\HeaderView($this->l11n);
$footerView = new \Web\Views\Lists\PaginationView($this->l11n);

$tasksList->setTemplate('/Web/Theme/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang[11]['Tasks']);
$headerView->addHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Status'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Priority'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Title'], 'sortable' => true,  'full' => true],
    ['title' => $this->l11n->lang[11]['Creator'], 'sortable' => true],
    ['title' => $this->l11n->lang[11]['Created'], 'sortable' => true]
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$tasksList->addView('header', $headerView);
$tasksList->addView('footer', $footerView);
?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <button><?= $this->l11n->lang[11]['New']; ?></button>
        </div>
    </div>
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><?= $this->l11n->lang[11]['Interval']; ?>
                <li><select>
                        <option value="0" selected><?= $this->l11n->lang[11]['All']; ?>
                        <option value="1"><?= $this->l11n->lang[11]['Today']; ?>
                        <option value="2"><?= $this->l11n->lang[11]['Week']; ?>
                        <option value="3"><?= $this->l11n->lang[11]['Month']; ?>
                        <option value="4"><?= $this->l11n->lang[11]['Year']; ?>
                    </select>
            </ul>
        </div>
    </div>

    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->l11n->lang[11]['Statistics']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

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
</div>
<div class="b-6">
    <?= $tasksList->getOutput(); ?>
</div>